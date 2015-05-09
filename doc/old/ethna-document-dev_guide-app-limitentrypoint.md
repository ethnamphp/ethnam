# エントリポイント毎に実行可能なアクションを制限する

## エントリポイント毎に実行可能なアクションを制限する [](ethna-document-dev_guide-app-limitentrypoint.html#cb7aceb6 "cb7aceb6")

デフォルトではエントリポイントは以下のように記述されていると思います。この場合(デフォルト状態で実行されるアクションは指定されていますが)その他ユーザからフォーム値によって指定されたあらゆるアクションを実行して(あるいはしようとして)しまいます。

    <?php
    include_once('/tmp/sample/app/Sample_Controller.php');
    Sample_Controller::main('Sample_Controller', 'index');
    ?>

エントリポイントが1つの場合は特に問題はありませんが、エントリポイントが複数になってくると、この動きはあまり好ましいものではなくなってきます。

こうした場合、Ethna\_Controller::main()メソッドの第2引数に配列を指定することで、実行するアクション名を限定させることが出来ます。具体的には

    Sample_Controller::main('Sample_Controller', array(
     'index',
     'user_login',
     'user_login_do',
    ));

のように記述します。この場合は、配列の最初の要素'index'がデフォルトのアクション名になり、また、'index'、'login'、'login\_do'以外のアクションがリクエストされた場合でもそれらは未定義として扱われます。

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

_see also:_ [未定義のアクションが指定された場合に特定のアクションを実行する](ethna-document-dev_guide-app-fallbackentrypoint.html "ethna-document-dev\_guide-app-fallbackentrypoint (1240d)")

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
<!-- ??BEGIN id:trackback -->
<!-- ?? END id:trackback --><!-- ?? END id:attach -->
<!-- ?? END id:summary -->
<!-- ??END id:content -->
<!-- ?? END id:wrap_content --><!-- ??sidebar?? ========================================================== -->
<!-- ??BEGIN id:wrap_sidebar -->

<!-- ??BEGIN id:search_form -->

## 検索

<form action="http://ethna.jp/index.php?cmd=search" method="post">
            <input type="hidden" name="encode_hint" value="??">
            <input type="text" name="word" value="" size="20">
            <input type="submit" value="検索"><br>
            <input type="radio" name="type" value="AND" checked id="and_search"><label for="and_search">AND検索</label>
            <input type="radio" name="type" value="OR" id="or_search"><label for="or_search">OR検索</label>
    </form>

<!-- END id:search_form -->
<!-- ??BEGIN id:download_link -->

## ダウンロード

[![](image/minilogo.gif)Ethna-2.6.0(beta2)](ethna-download.html)

[![](image/minilogo.gif)Ethna-2.5.0(stable)](ethna-download.html)

<!-- END id:download_link -->
<!-- ??BEGIN id:download_link -->

## Quick Links

- [フォーラム(質問/要望等)](ethna-community-forum.html)
- [メーリングリスト](http://ml.ethna.jp/mailman/listinfo/users)

- [チュートリアル](ethna-document-tutorial.html)
- [開発マニュアル](ethna-document-dev_guide.html)
- [変更点一覧](ethna-document-changes.html)

- [TODO(ロードマップ)](TODO.html)
- [ロゴ](ethna-logo.html)

<!-- END id:download_link -->
<!-- ??BEGIN id:search_form -->

