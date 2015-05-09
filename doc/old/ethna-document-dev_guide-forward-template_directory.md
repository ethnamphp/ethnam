# テンプレートディレクトリを変更する

## テンプレートディレクトリを変更する [](ethna-document-dev_guide-forward-template_directory.html#z6cf629d "z6cf629d")

デフォルトでは、テンプレートは template ディレクトリに置かれます。このディレクトリはコントローラの$directoryメンバ変数を変更することで任意のディレクトリに設定することが出来るので好み応じて変更してください。

例えば、テンプレートのディレクトリをデフォルトのtemplateからtplに変更する場合は以下のように記述します。

    var $directory = array(
         'action' => 'app/action',
         'etc' => 'etc',
         'filter' => 'app/filter',
         'locale' => 'locale',
         'log' => 'log',
         'plugins' => array(),
    - 'template' => 'template',
    + 'template' => 'tpl',
         'template_c' => 'tmp',
         'tmp' => 'tmp',
         'view' => 'app/view',
     );

なお、このメンバ変数を相対パスで記述した場合は「アプリケーションベースディレクトリからの相対パス」として扱われます。もちろん絶対パス('/'で始まるパス)で記述することも可能です。

