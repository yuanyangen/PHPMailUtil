<?php
namespace PHPMailUtil;

/**
 * 实现对php mail函数的封装， 支持添加发件人， 收件人， 添加附件，添加html或者text格式的正文
 * 
 * todo 抄送的功能
 * Class Mail
 * @package PHPMailUtil
 */
class Mail
{
    /**
     * 支持的MIME的类型
     * @var array
     */
    private $MIMETypes = array(
        '323'=>'text/h323',
        'acx'=>'application/internet-property-stream',
        'ai'=>'application/postscript',
        'aif'=>'audio/x-aiff',
        'aifc'=>'audio/x-aiff',
        'aiff'=>'audio/x-aiff',
        'asf'=>'video/x-ms-asf',
        'asr'=>'video/x-ms-asf',
        'asx'=>'video/x-ms-asf',
        'au'=>'audio/basic',
        'avi'=>'video/x-msvideo',
        'axs'=>'application/olescript',
        'bas'=>'text/plain',
        'bcpio'=>'application/x-bcpio',
        'bin'=>'application/octet-stream',
        'bmp'=>'image/bmp',
        'c'=>'text/plain',
        'cat'=>'application/vnd.ms-pkiseccat',
        'cdf'=>'application/x-cdf',
        'cer'=>'application/x-x509-ca-cert',
        'class'=>'application/octet-stream',
        'clp'=>'application/x-msclip',
        'cmx'=>'image/x-cmx',
        'cod'=>'image/cis-cod',
        'cpio'=>'application/x-cpio',
        'crd'=>'application/x-mscardfile',
        'crl'=>'application/pkix-crl',
        'crt'=>'application/x-x509-ca-cert',
        'csh'=>'application/x-csh',
        'css'=>'text/css',
        'dcr'=>'application/x-director',
        'der'=>'application/x-x509-ca-cert',
        'dir'=>'application/x-director',
        'dll'=>'application/x-msdownload',
        'dms'=>'application/octet-stream',
        'doc'=>'application/msword',
        'dot'=>'application/msword',
        'dvi'=>'application/x-dvi',
        'dxr'=>'application/x-director',
        'eps'=>'application/postscript',
        'etx'=>'text/x-setext',
        'evy'=>'application/envoy',
        'exe'=>'application/octet-stream',
        'fif'=>'application/fractals',
        'flr'=>'x-world/x-vrml',
        'gif'=>'image/gif',
        'gtar'=>'application/x-gtar',
        'gz'=>'application/x-gzip',
        'h'=>'text/plain',
        'hdf'=>'application/x-hdf',
        'hlp'=>'application/winhlp',
        'hqx'=>'application/mac-binhex40',
        'hta'=>'application/hta',
        'htc'=>'text/x-component',
        'htm'=>'text/html',
        'html'=>'text/html',
        'htt'=>'text/webviewhtml',
        'ico'=>'image/x-icon',
        'ief'=>'image/ief',
        'iii'=>'application/x-iphone',
        'ins'=>'application/x-internet-signup',
        'isp'=>'application/x-internet-signup',
        'jfif'=>'image/pipeg',
        'jpe'=>'image/jpeg',
        'jpeg'=>'image/jpeg',
        'jpg'=>'image/jpeg',
        'js'=>'application/x-javascript',
        'latex'=>'application/x-latex',
        'lha'=>'application/octet-stream',
        'lsf'=>'video/x-la-asf',
        'lsx'=>'video/x-la-asf',
        'lzh'=>'application/octet-stream',
        'm13'=>'application/x-msmediaview',
        'm14'=>'application/x-msmediaview',
        'm3u'=>'audio/x-mpegurl',
        'man'=>'application/x-troff-man',
        'mdb'=>'application/x-msaccess',
        'me'=>'application/x-troff-me',
        'mht'=>'message/rfc822',
        'mhtml'=>'message/rfc822',
        'mid'=>'audio/mid',
        'mny'=>'application/x-msmoney',
        'mov'=>'video/quicktime',
        'movie'=>'video/x-sgi-movie',
        'mp2'=>'video/mpeg',
        'mp3'=>'audio/mpeg',
        'mpa'=>'video/mpeg',
        'mpe'=>'video/mpeg',
        'mpeg'=>'video/mpeg',
        'mpg'=>'video/mpeg',
        'mpp'=>'application/vnd.ms-project',
        'mpv2'=>'video/mpeg',
        'ms'=>'application/x-troff-ms',
        'mvb'=>'application/x-msmediaview',
        'nws'=>'message/rfc822',
        'oda'=>'application/oda',
        'p10'=>'application/pkcs10',
        'p12'=>'application/x-pkcs12',
        'p7b'=>'application/x-pkcs7-certificates',
        'p7c'=>'application/x-pkcs7-mime',
        'p7m'=>'application/x-pkcs7-mime',
        'p7r'=>'application/x-pkcs7-certreqresp',
        'p7s'=>'application/x-pkcs7-signature',
        'pbm'=>'image/x-portable-bitmap',
        'pdf'=>'application/pdf',
        'pfx'=>'application/x-pkcs12',
        'pgm'=>'image/x-portable-graymap',
        'pko'=>'application/ynd.ms-pkipko',
        'pma'=>'application/x-perfmon',
        'pmc'=>'application/x-perfmon',
        'pml'=>'application/x-perfmon',
        'pmr'=>'application/x-perfmon',
        'pmw'=>'application/x-perfmon',
        'pnm'=>'image/x-portable-anymap',
        'pot,'=>'application/vnd.ms-powerpoint',
        'ppm'=>'image/x-portable-pixmap',
        'pps'=>'application/vnd.ms-powerpoint',
        'ppt'=>'application/vnd.ms-powerpoint',
        'prf'=>'application/pics-rules',
        'ps'=>'application/postscript',
        'pub'=>'application/x-mspublisher',
        'qt'=>'video/quicktime',
        'ra'=>'audio/x-pn-realaudio',
        'ram'=>'audio/x-pn-realaudio',
        'ras'=>'image/x-cmu-raster',
        'rgb'=>'image/x-rgb',
        'rmi'=>'audio/mid',
        'roff'=>'application/x-troff',
        'rtf'=>'application/rtf',
        'rtx'=>'text/richtext',
        'scd'=>'application/x-msschedule',
        'sct'=>'text/scriptlet',
        'setpay'=>'application/set-payment-initiation',
        'setreg'=>'application/set-registration-initiation',
        'sh'=>'application/x-sh',
        'shar'=>'application/x-shar',
        'sit'=>'application/x-stuffit',
        'snd'=>'audio/basic',
        'spc'=>'application/x-pkcs7-certificates',
        'spl'=>'application/futuresplash',
        'src'=>'application/x-wais-source',
        'sst'=>'application/vnd.ms-pkicertstore',
        'stl'=>'application/vnd.ms-pkistl',
        'stm'=>'text/html',
        'svg'=>'image/svg+xml',
        'sv4cpio'=>'application/x-sv4cpio',
        'sv4crc'=>'application/x-sv4crc',
        'swf'=>'application/x-shockwave-flash',
        't'=>'application/x-troff',
        'tar'=>'application/x-tar',
        'tcl'=>'application/x-tcl',
        'tex'=>'application/x-tex',
        'texi'=>'application/x-texinfo',
        'texinfo'=>'application/x-texinfo',
        'tgz'=>'application/x-compressed',
        'tif'=>'image/tiff',
        'tiff'=>'image/tiff',
        'tr'=>'application/x-troff',
        'trm'=>'application/x-msterminal',
        'tsv'=>'text/tab-separated-values',
        'txt'=>'text/plain',
        'uls'=>'text/iuls',
        'ustar'=>'application/x-ustar',
        'vcf'=>'text/x-vcard',
        'vrml'=>'x-world/x-vrml',
        'wav'=>'audio/x-wav',
        'wcm'=>'application/vnd.ms-works',
        'wdb'=>'application/vnd.ms-works',
        'wks'=>'application/vnd.ms-works',
        'wmf'=>'application/x-msmetafile',
        'wps'=>'application/vnd.ms-works',
        'wri'=>'application/x-mswrite',
        'wrl'=>'x-world/x-vrml',
        'wrz'=>'x-world/x-vrml',
        'xaf'=>'x-world/x-vrml',
        'xbm'=>'image/x-xbitmap',
        'xla'=>'application/vnd.ms-excel',
        'xlc'=>'application/vnd.ms-excel',
        'xlm'=>'application/vnd.ms-excel',
        'xls'=>'application/vnd.ms-excel',
        'xlt'=>'application/vnd.ms-excel',
        'xlw'=>'application/vnd.ms-excel',
        'xof'=>'x-world/x-vrml',
        'xpm'=>'image/x-xpixmap',
        'xwd'=>'image/x-xwindowdump',
        'z'=>'application/x-compress',
        'zip'=>'application/zip'
    );
    /**
     * @var string $to The email address, (or addresses, if comma separated), of the person to which this email should be sent.
     **/
    public $to;
    /**
     * @var string $from The email address that this mail will be delivered from. Bear in mind that this can be anything, but that if the email
     *                   domain doesn't match the actual domain the message was sent from, some email clients will reject the message as spam.
     **/
    public $from;

    /**
     * @var string $subject The subject line of the email
     **/
    public $subject;
    /**
     * @var string $textContent The plaintext version of the message to be sent.
     **/
    public $textContent;
    /**
     * @var string $htmlContent The HTML version of the message to be sent.
     **/
    public $htmlContent;

    /**
     * @var string $body The complete body of the email that will be sent, including all mixed content.
     **/
    public $body;
    /**
     * @var array $attachments An array of file paths pointing to the attachments that should be included with this email.
     **/
    public $attachments;

    /**
     * @var array $headers An array of the headers that will be included in this email.
     **/
    public $headers;
    /**
     * @var string $headerString The string, (and therefore final), representation of the headers for this email message.
     **/
    public $headerString;
    /**
     * @var string $boundaryHash The string that acts as a separator between the various mixed parts of the email message.
     **/
    public $boundaryHash;
    /**
     * @var boolean $sent Whether or not this email message was successfully sent.
     **/
    public $sent;

    /**
     * Mail constructor.
     * @param $to string 目标地址
     * @param $from  string 源地址
     * @param $subject string 标题
     * @param $text_content string 正文
     * @param $html_content string html格式的正文
     */
    public function __construct($to, $from, $subject, $text_content = "", $html_content = "")
    {
        $this->to = $to;
        $this->from = $from;
        $this->subject = $subject;
        $this->textContent = $text_content;
        $this->htmlContent = $html_content;
        $this->body = '';
        $this->attachments = array();
        $this->headers = array();
        $this->boundaryHash = md5(date('r', time()));
    }

    /**
     * The send() method processes all headers, body elements and attachments and then actually sends the resulting final email.
     **/
    public function send()
    {
        $this->prepareHeaders();
        $this->prepareBody();

        if (!empty($this->attachments)) {
            $this->prepareAttachments();
        }
        $this->sent = mail($this->to, $this->subject, $this->body, $this->headerString);
        return $this->sent;
    }

    /**
     * This method allows the user to add a new header to the message
     * @param string $header The text for the header the user wants to add. Note that this string must be a properly formatted email header.
     **/
    public function addHeader($header)
    {
        $this->headers[] = $header;
    }

    /**
     * Add a filepath to the list of files to be sent with this email.
     * @param string $filePath The path to the file that should be sent.
     * @param string $fileName 文件名， 可选， 如果不填， 文件名就会从路径中获取
     * @param string $mimeType 文件类型， 如果不填， 就会从文件名中获取
     **/
    public function addAttachment($filePath, $fileName = "", $mimeType = "")
    {
        $this->attachments[] = array(
            'path' => $filePath,
            'file_name' => $fileName,
            'mime_type' => $mimeType,
        );
    }

    /**
     * 准备邮件的正文
     */
    private function prepareBody()
    {
        $this->body .= "--PHP-mixed-{$this->boundaryHash}\n";
        $this->body .= "Content-Type: multipart/alternative; charset=utf-8; boundary=\"PHP-alt-{$this->boundaryHash}\"\n\n";
        if (!empty($this->textContent)) $this->prepareText();
        if (!empty($this->htmlContent)) $this->prepareHtml();
        $this->body .= "--PHP-alt-{$this->boundaryHash}--\n\n";
    }

    /**
     * 拼接组成邮件的头
     */
    private function prepareHeaders()
    {
        $this->setDefaultHeaders();
        $this->headerString = implode(PHP_EOL, $this->headers) . PHP_EOL;
    }

    /**
     * 设置默认的邮件header
     */
    private function setDefaultHeaders()
    {
        $this->headers[] = 'MIME-Version: 1.0';
        $this->headers[] = "From: {$this->from}";
        $this->headers[] = "To: {$this->to}";
        $this->headers[] = "Subject: {$this->subject}";
        $this->headers[] = "Content-type: multipart/mixed; charset=utf-8; boundary=\"PHP-mixed-{$this->boundaryHash}\"";
    }

    /**
     * 将附件的内容添加进入邮件的正文
     */
    private function prepareAttachments()
    {
        foreach ($this->attachments as $attachment) {
            $filePath = $attachment['path'];
            if (empty($attachment['file_name'])) {
                $fileName = basename($filePath);
            } else {
                $fileName = $attachment['file_name'];
            }

            if ($attachment['mime_type']) {
                $mimeType = $attachment['mime_type'];
            } else {
                $fileInfo = explode('.', $fileName);
                $suffix = array_pop($fileInfo);
                $mimeType = empty($this->MIMETypes[$suffix]) ? 'application/octet-stream' : $this->MIMETypes[$suffix];
            }
            $this->body .= "--PHP-mixed-{$this->boundaryHash}\n";
            $this->body .= "Content-Type: {$mimeType}; name={$fileName}\n";
            $this->body .= "Content-Transfer-Encoding: base64\n";
            $this->body .= "Content-Disposition: attachment\n\n";
            $this->body .= chunk_split(base64_encode(file_get_contents($filePath)));
            $this->body .= "\n";
        }
        $this->body .= "--PHP-mixed-{$this->boundaryHash}--\n";
    }

    /**
     * 添加text
     */
    private function prepareText()
    {
        $this->body .= "--PHP-alt-{$this->boundaryHash}\n";
        $this->body .= "Content-Type: text/plain; charset=utf-8\n";
        $this->body .= "Content-Transfer-Encoding: 7bit\n\n";
        $this->body .= $this->textContent . "\n\n";
    }

    /**
     * 将html的正文写入到邮件正文中
     */
    private function prepareHtml()
    {
        $this->body .= "--PHP-alt-{$this->boundaryHash}\n";
        $this->body .= "Content-Type: text/html; charset=utf-8\n";
        $this->body .= "Content-Transfer-Encoding: 7bit\n\n";
        $this->body .= $this->htmlContent . "\n\n";
    }
}
