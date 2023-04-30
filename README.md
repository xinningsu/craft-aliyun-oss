# craft-aliyun-oss
Aliyun OSS integration for Craft CMS, 阿里云对象存储整合Craft CMS

This plugin provides an [Aliyun OSS](https://www.aliyun.com/product/oss) integration for [Craft CMS](https://craftcms.com/), with this plugin we can create an Aliyun OSS volume type for Craft CMS.

## Requirements

- PHP 8.0.2 or later
- Craft CMS 4.0 or later

## Installation

You can install this plugin from the Plugin Store or with Composer.

#### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for “Aliyun OSS Volume”. Then press **Install** in its modal window.

#### With Composer

Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project

# tell Composer to load the plugin
composer require xinningsu/craft-aliyun-oss

# tell Craft to install the plugin
./craft plugin/install craft-aliyun-oss
```

## Setup

To create a new Aliyun OSS filesystem to use with your volumes,

- Login admin, visit **Settings** → **Filesystems**,
- Press **New filesystem**.
- Select “Aliyun OSS” for the **Filesystem Type**
- Setting and configure as needed.
