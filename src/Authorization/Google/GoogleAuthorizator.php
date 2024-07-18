<?php

declare(strict_types=1);

namespace SixtyEightPublishers\OAuth\Authorization\Google;

use League\OAuth2\Client\Provider\AbstractProvider;
use SixtyEightPublishers\OAuth\Authorization\AbstractAuthorizator;
use SixtyEightPublishers\OAuth\Config\ConfigInterface;
use League\OAuth2\Client\Provider\Google;
use function array_merge;
use function assert;

final class GoogleAuthorizator extends AbstractAuthorizator
{
    public const OptClientId = 'clientId';
    public const OptClientSecret = 'clientSecret';
    public const OptOptions = 'options';

    protected function createClient(ConfigInterface $config): AbstractProvider
    {
        $options = array_merge(
            $config->has(self::OptOptions) ? $config->get(self::OptOptions) : [],
            [
                self::OptClientId => (string) $config->get(self::OptClientId),
                self::OptClientSecret => (string) $config->get(self::OptClientSecret),
            ],
        );

        return new Google($options);;
    }
}
