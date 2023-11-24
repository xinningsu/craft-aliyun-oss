<?php

declare(strict_types=1);

namespace Sulao\CraftAliyunOss;

use Craft;
use craft\behaviors\EnvAttributeParserBehavior;
use craft\flysystem\base\FlysystemFs;
use craft\helpers\App;
use craft\helpers\Assets;
use Iidestiny\Flysystem\Oss\OssAdapter;
use League\Flysystem\FilesystemAdapter;

class Fs extends FlysystemFs
{
    public string $keyId = '';
    public string $secret = '';
    public string $endpoint = '';
    public string $bucket = '';
    public string $isCName = '';
    public string $root = '';

    public static function displayName(): string
    {
        return 'Aliyun OSS';
    }

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['parser'] = [
            'class'      => EnvAttributeParserBehavior::class,
            'attributes' => ['keyId', 'secret', 'endpoint', 'bucket', 'isCName', 'root'],
        ];

        return $behaviors;
    }

    protected function defineRules(): array
    {
        return array_merge(parent::defineRules(), [
            [['keyId', 'secret', 'endpoint', 'bucket',], 'required'],
        ]);
    }

    public function getSettingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate('craft-aliyun-oss/fsSettings', [
            'fs'      => $this,
            'periods' => array_merge(['' => ''], Assets::periodList()),
        ]);
    }

    protected function createAdapter(): FilesystemAdapter
    {
        return new OssAdapter(
            App::parseEnv($this->keyId),
            App::parseEnv($this->secret),
            App::parseEnv($this->endpoint),
            App::parseEnv($this->bucket),
            (bool)App::parseEnv($this->isCName),
            App::parseEnv($this->root)
        );
    }

    protected function invalidateCdnPath(string $path): bool
    {
        return true;
    }
}
