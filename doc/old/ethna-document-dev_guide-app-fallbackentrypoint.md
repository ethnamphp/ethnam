# 未定義のアクションが指定された場合に特定のアクションを実行する

## 未定義のアクションが指定された場合に特定のアクションを実行する [](ethna-document-dev_guide-app-fallbackentrypoint.html#p41b229b "p41b229b")

想定外、あるいは許可されていないアクションがリクエストされた場合\*1、通常はアクションが未定義としてエラーになります。しかしながら、未定義のアクションが指定された場合にも特定のアクションを実行したくなることもあるかと思います(エラー用アクションや、問答無用でトップページを表示、等)。

こういった場合には、Ethna\_Controller::main()メソッドの第3引数($fallback\_action\_name)に、アクション未定義の場合に実行したいアクション名を指定することで処理を実現することができます。具体的には、

    Sample_Controller::main('Sample_Controller', array(
     'index',
     'login_*',
    ), 'undef');

のように記述します。この場合は、第2引数に指定したアクション以外が指定されると'undef'アクションが実行されます(undefアクションが定義されていない場合はエラーとなります)。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1 [エントリポイント毎に実行可能なアクションを制限する](ethna-document-dev_guide-app-limitentrypoint.html "ethna-document-dev\_guide-app-limitentrypoint (706d)")参照  

<!-- ??END id:note -->
