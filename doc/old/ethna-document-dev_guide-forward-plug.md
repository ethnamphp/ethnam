# アクションクラスからの戻り値に応じてコントローラで遷移先を決定する

## アクションクラスからの戻り値に応じてコントローラで遷移先を決定する

Controllerに遷移先定義を追加します。app/{$アプリケーションID}\_Controller.phpを以下のように編集してください。

    /**
     * @var array forward定義
     */
    var $forward = array(
         /*
          * TODO: ここにforward先を記述してください
          *
          * 記述例：
          *
          * 'index' => array(
          * 'view_name' => 'Sample_View_Index',
          * ),
          */
    + 'login' => array(
    + 'view_name' => 'Sample_View_Login',
    + 'forward_path' => 'login.tpl',
    + ),
    );

これで、'login'という遷移先にSample\_View\_Loginというビュークラスと、login.tplというテンプレートファイルが関連付けられます。

