<?php


namespace alexshadie\fns;


class Version
{
    private string $version;
    private string $revision;

    /**
     * Version constructor.
     * @param string $version
     * @param string $revision
     */
    public function __construct(string $version, string $revision)
    {
        $this->version = $version;
        $this->revision = $revision;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getRevision(): string
    {
        return $this->revision;
    }
}