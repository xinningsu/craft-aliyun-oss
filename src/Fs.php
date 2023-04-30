<?php

declare(strict_types=1);

namespace Sulao\CraftAliyunOss;

use Craft;
use craft\behaviors\EnvAttributeParserBehavior;
use craft\flysystem\base\FlysystemFs;
use craft\helpers\Assets;
use Iidestiny\Flysystem\Oss\OssAdapter;
use League\Flysystem\FilesystemAdapter;

class Fs extends FlysystemFs
{
    public string $keyId = '';
    public string $secret = '';
    public string $endpoint = '';
    public string $bucket = '';
    public bool   $isCName = false;
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
            $this->keyId,
            $this->secret,
            $this->endpoint,
            $this->bucket,
            $this->isCName,
            $this->root
        );
    }

    protected function invalidateCdnPath(string $path): bool
    {
        return true;
    }
}
