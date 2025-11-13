<?php

/**
 * League.Uri (https://uri.thephpleague.com)
 *
 * (c) Ignace Nyamagana Butera <nyamsprod@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace League\Uri;

use ValueError;

/*
 *  Supported schemes and corresponding default port.
 *
 * @see https://github.com/python-hyper/hyperlink/blob/master/src/hyperlink/_url.py for the curating list definition
 * @see https://www.iana.org/assignments/uri-schemes/uri-schemes.xhtml
 * @see https://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
 */
enum SchemePort: string
{
    case Acap = 'acap';
    case Afp = 'afp';
    case Data = 'data';
    case Dict = 'dict';
    case Dns = 'dns';
    case File = 'file';
    case Ftp = 'ftp';
    case Gopher = 'gopher';
    case Http = 'http';
    case Https = 'https';
    case Imap = 'imap';
    case Imaps = 'imaps';
    case Ipp = 'ipp';
    case Ipps = 'ipps';
    case Irc = 'irc';
    case Ircs = 'ircs';
    case Ldap = 'ldap';
    case Ldaps = 'ldaps';
    case Mms = 'mms';
    case Msrp = 'msrp';
    case Msrps = 'msrps';
    case Mtqp = 'mtqp';
    case Nfs = 'nfs';
    case Nntp = 'nntp';
    case Nntps = 'nntps';
    case Pop = 'pop';
    case Prospero = 'prospero';
    case Redis = 'redis';
    case Rsync = 'rsync';
    case Rtsp = 'rtsp';
    case Rtsps = 'rtsps';
    case Rtspu = 'rtspu';
    case Sftp = 'sftp';
    case Wss = 'wss';
    case Ws = 'ws';
    case Smb = 'smb';
    case Smtp = 'smtp';
    case Snmp = 'snmp';
    case Ssh = 'ssh';
    case Svn = 'svn';
    case Telnet = 'telnet';
    case Tn3270 = 'tn3270';
    case Ventrilo = 'ventrilo';
    case Vnc = 'vnc';
    case Wais = 'wais';

    public function port(): ?int
    {
        return match ($this) {
            self::Acap => 674,
            self::Afp => 548,
            self::Dict => 2628,
            self::Dns => 53,
            self::Ftp => 21,
            self::Http, self::Ws => 80,
            self::Https, self::Wss => 443,
            self::Gopher => 70,
            self::Imap => 143,
            self::Imaps => 993,
            self::Ipp, self::Ipps => 631,
            self::Irc => 194,
            self::Ircs => 6697,
            self::Ldap => 389,
            self::Ldaps => 636,
            self::Mms => 1755,
            self::Msrp, self::Msrps => 2855,
            self::Mtqp => 1038,
            self::Nfs => 111,
            self::Nntp => 119,
            self::Nntps => 563,
            self::Pop => 110,
            self::Prospero => 1525,
            self::Redis => 6379,
            self::Rsync => 873,
            self::Rtsp => 554,
            self::Rtsps => 322,
            self::Rtspu => 5005,
            self::Sftp, self::Ssh => 22,
            self::Smb => 445,
            self::Smtp => 25,
            self::Snmp => 161,
            self::Svn => 3690,
            self::Telnet, self::Tn3270 => 23,
            self::Ventrilo => 3784,
            self::Vnc => 5900,
            self::Wais => 210,
            default => null,
        };
    }

    /**
     * @return list<self>
     */
    public static function fromPort(?int $port): array
    {
        null === $port || 0 <= $port || throw new ValueError('The submitted port cannot be negative.');

        static $reverse = [];
        if ([] === $reverse) {
            foreach (self::cases() as $case) {
                $defaultPort = $case->port();
                if (null === $defaultPort) {
                    continue;
                }
                $reverse[$defaultPort] ??= [];
                $reverse[$defaultPort][] = $case;

            }
        }

        return $reverse[$port] ?? [];
    }
}
