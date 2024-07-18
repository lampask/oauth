<?php

declare(strict_types=1);

namespace SixtyEightPublishers\OAuth\Bridge\Nette\DI;

use Nette\DI\Definitions\ServiceDefinition;
use Nette\Schema\Expect;
use SixtyEightPublishers\OAuth\Authorization\Google\GoogleAuthorizator;

final class GoogleOAuthExtension extends AbstractIntegrationExtension
{
    protected function getDefaultFlowName(): string
    {
        return 'google';
    }

    protected function getFlowConfigOptions(): array
    {
        return [
            GoogleAuthorizator::OptClientId => Expect::string()
                ->required()
                ->dynamic(),
            GoogleAuthorizator::OptClientSecret => Expect::string()
                ->required()
                ->dynamic(),
            GoogleAuthorizator::OptOptions => Expect::array(),
        ];
    }

    protected function defineAuthorizatorService(): ServiceDefinition
    {
        return $this->getContainerBuilder()
            ->addDefinition($this->prefix('authorizator'))
            ->setAutowired(false)
            ->setFactory(GoogleAuthorizator::class);
    }
}
