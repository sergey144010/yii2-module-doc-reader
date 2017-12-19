# About
If you have documentation files such as
https://github.com/yiisoft/yii2/tree/master/docs/guide in your local machine. Or just fork.
You may want to offline read them in the browser like online. 
This module will help in this.
Always fresh documentation after `pull`.

# Install
You must have install application like [yii2-app-basic](https://github.com/yiisoft/yii2-app-basic) or
[yii2-app-advanced](https://github.com/yiisoft/yii2-app-advanced).

1. Go to the root directory of your project and run:
`composer require "erusev/parsedown": "*"`
2. Copy this repository to the root of your project.
Or do `git clone https://github.com/sergey144010/yii2-module-doc-reader` and create the following folder structure.
```
-your-application
  |
  |-...
  |-controllers
  |-models
  |-views
  |-...
  |-modules
  |    |
  |    |-sergey144010
  |          |
  |          |-docReader
  |               |
  |               ...
  ...
```
3. Configure your application configuration as follows:
```
$config = [
...
    'modules' => [
        'reader' => [
            'class' => 'app\modules\sergey144010\docReader\Module',
            'docPath' => 'path\to\yii2\docs\guide',
        ],
    ],
...
```
# Usage
Now the documentation is available at address `index.php?r=reader/doc/index`
