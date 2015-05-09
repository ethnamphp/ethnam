# ビュースクリプトの配置ディレクトリを変更する

## ビュースクリプトの配置ディレクトリを変更する [](ethna-document-dev_guide-forward-view_dir.html#z6cf629d "z6cf629d")

デフォルトでは、ビュークラスが定義されたスクリプト(ビュースクリプト)はapp/viewに置かれます。このディレクトリはコントローラの$directoryメンバ変数を変更することで任意のディレクトリに設定することが出来るので好み応じて変更してください。

例えば、アクションスクリプトのディレクトリをデフォルトのapp/viewからviewに変更する場合は以下のように記述します。

    var $directory = array(
         'action' => 'app/action',
         'etc' => 'etc',
         'filter' => 'app/filter',
         'locale' => 'locale',
         'log' => 'log',
         'plugins' => array(),
         'template' => 'template',
         'template_c' => 'tmp',
         'tmp' => 'tmp',
    - 'view' => 'app/view',
    + 'view' => 'view',
      );

なお、このメンバ変数を相対パスで記述した場合は「アプリケーションベースディレクトリからの相対パス」として扱われます。もちろん絶対パス('/'で始まるパス)で記述することも可能です。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
