<?php

namespace Akhaled\CPanelAPI\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubDomainCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $domain;
    public $subdomain;
    public $path;

    public function __construct(string $domain, string $subdomain, string $path)
    {
        $this->domain = $domain;
        $this->subdomain = $subdomain;
        $this->path = $path;
    }

    public function build()
    {
        return $this
            ->subject('Domain created ✅')
            ->markdown('cpanel-api::mails.subdomains.created', [
                'domain' => $this->domain,
                'subdomain' => $this->subdomain,
                'path' => $this->path,
            ]);
    }
}
