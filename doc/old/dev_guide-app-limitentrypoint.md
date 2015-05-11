# エントリポイント毎に実行可能なアクションを制限する

## エントリポイント毎に実行可能なアクションを制限する

デフォルトではエントリポイントは以下のように記述されていると思います。この場合(デフォルト状態で実行されるアクションは指定されていますが)その他ユーザからフォーム値によって指定されたあらゆるアクションを実行して(あるいはしようとして)しまいます。

    <?php
    include_once('/tmp/sample/app/Sample_Controller.php');
    Sample_Controller::main('Sample_Controller', 'index');
    ?>

エントリポイントが1つの場合は特に問題はありませんが、エントリポイントが複数になってくると、この動きはあまり好ましいものではなくなってきます。

こうした場合、Ethna_Controller::main()メソッドの第2引数に配列を指定することで、実行するアクション名を限定させることが出来ます。具体的には

    Sample_Controller::main('Sample_Controller', array(
     'index',
     'user_login',
     'user_login_do',
    ));

のように記述します。この場合は、配列の最初の要素'index'がデフォルトのアクション名になり、また、'index'、'login'、'login_do'以外のアクションがリクエストされた場合でもそれらは未定義として扱われます。

ただ、実装したアクションが増えてくるとエントリポイントにアクションを記述するのも面倒になってきます。

    // 正気の沙汰とは思えない例
    Sample_Controller::main('Sample_Controller', array(
     'index',
     'user_login',
     'user_login_do',
     'user_add',
     'user_add_do',
     'user_modify',
     'user_modify_do',
     'user_remove',
     'user_remove_do',
     'user_logout',
     ...
    ));

こんな場合は、アスタリスクを使用することで楽をすることが出来ます。

    // user_で始まるアクションは全て受け付ける
    Sample_Controller::main('Sample_Controller', array(
     'index',
     'user_*',
    ));

アスタリスクはアクション名の末尾でのみ使用可能です。

なお、未定義のアクションが指定された場合に特定のアクションを実行させる方法については下記をご覧下さい。

_see also:_ [未定義のアクションが指定された場合に特定のアクションを実行する](dev_guide-app-fallbackentrypoint.md)

