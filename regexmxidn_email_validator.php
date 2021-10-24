<?
class emailValidator {
    /**
     * @var string the regular expression used to validate the attribute value.
     * @see http://www.regular-expressions.info/email.html
     */
    public $pattern = '/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/';
    /**
     * @var bool whether to check whether the email's domain exists and has either an A or MX record.
     * Be aware that this check can fail due to temporary DNS problems even if the email address is
     * valid and an email would be deliverable. Defaults to false.
     */
    public $checkDNS = false;
    /**
     * @var bool whether validation process should take into account IDN (internationalized domain
     * names). Defaults to false meaning that validation of emails containing IDN will always fail.
     * Note that in order to use IDN validation you have to install and enable `intl` PHP extension,
     * otherwise an exception would be thrown.
     */
    public $enableIDN = false;
    public function __construct($checkDNS = false, $enableIDN = false) {
        $this->checkDNS = $checkDNS;
        $this->enableIDN = $enableIDN;
        if ($enableIDN && !function_exists('idn_to_ascii')) {
            throw new \Exception('In order to use IDN validation intl extension must be installed and enabled.');
        }
    }
    public function validate($value) {
        if (!is_string($value)) {
            $valid = false;
        } elseif (!preg_match('/^(?P<name>(?:"?([^"]*)"?\s)?)(?:\s+)?(?:(?P<open><?)((?P<local>.+)@(?P<domain>[^>]+))(?P<close>>?))$/i', $value, $matches)) {
            $valid = false;
        } else {
            if ($this->enableIDN) {
                $matches['local'] = $this->idnToAscii($matches['local']);
                $matches['domain'] = $this->idnToAscii($matches['domain']);
                $value = $matches['name'] . $matches['open'] . $matches['local'] . '@' . $matches['domain'] . $matches['close'];
            }
            if (strlen($matches['local']) > 64) {
                // The maximum total length of a user name or other local-part is 64 octets. RFC 5322 section 4.5.3.1.1
                // http://tools.ietf.org/html/rfc5321#section-4.5.3.1.1
                $valid = false;
            } elseif (strlen($matches['local'] . '@' . $matches['domain']) > 254) {
                // There is a restriction in RFC 2821 on the length of an address in MAIL and RCPT commands
                // of 254 characters. Since addresses that do not fit in those fields are not normally useful, the
                // upper limit on address lengths should normally be considered to be 254.
                //
                // Dominic Sayers, RFC 3696 erratum 1690
                // http://www.rfc-editor.org/errata_search.php?eid=1690
                $valid = false;
            } else {
                $valid = preg_match($this->pattern, $value);
                if ($valid && $this->checkDNS) {
                    $valid = $this->isDNSValid($matches['domain']);
                }
            }
        }
        return ($valid===false)? false : true;
    }
    protected function isDNSValid($domain) {
        return $this->hasDNSRecord($domain, true) || $this->hasDNSRecord($domain, false);
    }
    private function hasDNSRecord($domain, $isMX) {
        $normalizedDomain = $domain . '.';
        if (!checkdnsrr($normalizedDomain, ($isMX ? 'MX' : 'A'))) {
            return false;
        }
        try {
            // dns_get_record can return false and emit Warning that may or may not be converted to ErrorException
            $records = dns_get_record($normalizedDomain, ($isMX ? DNS_MX : DNS_A));
        } catch (ErrorException $exception) {
            return false;
        }
        return !empty($records);
    }
    private function idnToAscii($idn) {
        if (PHP_VERSION_ID < 50600) {
            return idn_to_ascii($idn);
        }
        return idn_to_ascii($idn, IDNA_NONTRANSITIONAL_TO_ASCII, INTL_IDNA_VARIANT_UTS46);
    }
}
/*
 * USING
 */
// validate just by regex
$validator = new emailValidator();
$check = $validator->validate('test@test.com');
var_dump($check); // return true
$check = $validator->validate('test.com');
var_dump($check); // return false
// validate by regex and DNS records
$validator = new emailValidator(true);
$check = $validator->validate('test@test.com');
var_dump($check); // return true or false
// validate by regex, DNS records and IDN
$validator = new emailValidator(true, true);
$check = $validator->validate('test@test.com');
var_dump($check); // return true or false
