<?php namespace Sidex\Core\Framework;

class Log {

    /**
     * The log file path.
     *
     * @var string
     */
    protected $file = APPATH;

    /**
     * The file pointer resource.
     *
     * @var Resource id #
     */
    protected $stream;

    /**
     * Write an error exception into a log file.
     *
     * @access static
     * @param  Exception  $exception
     * @param  string     $file
     */
    public static function error($exception, $file = null)
    {
        $self = new self($file);
        $self->wirte(sprintf("%s in %s (%d)\r\n",
            $exception->getMessage(), $exception->getFile(),
            $exception->getLine()
        ));
        $self->close();
    }

    /**
     * Class constructor.
     *
     * @access public
     * @param  string $file
     */
    public function __construct($file = null)
    {
        $this->file = $this->configureLogFile($file);
        $this->open();
    }

    /**
     * Writes the contents of string to the file stream pointed.
     *
     * @access public
     * @param  string  $string
     * @return mixed
     */
    public function wirte($string = '')
    {
        return fwrite($this->stream, sprintf("[%s] %s", date('Y-m-d h:i:s'), $string));
    }

    /**
     * Binds a named resource, specified by filename, to a stream.
     *
     * @access protected
     * @param  string  $mode
     */
    protected function open($mode = 'a')
    {
        $this->stream = fopen($this->file, $mode);

        if ($this->stream === false) {
            die("Cannot write to file: {$this->file}, please ensure that is writable.");
        }
    }

    /**
     * The file pointed to by handle is closed.
     *
     * @access protected
     * @return boolean
     */
    protected function close()
    {
        return fclose($this->stream);
    }


    /**
     * Configure a log file to write.
     *
     * @access protected
     * @param  string  $file
     */
    protected function configureLogFile($file)
    {
        if (is_null($file) === true) {
            $this->file .= 'logs/' . date('Y-m-d') . '.log';
        } else {
            $this->file .= 'logs/' . $file;
        }

        return normalize_path($this->file);
    }

    // end class...
}

/* End of file Log.php */
/* Location: ./(<application folder>/libraries/<namespace>)/Log.php */
