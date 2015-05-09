# アクションスクリプトのスケルトンを生成する- Ethna - PHPウェブアプリケーションフレームワーク</title>
  - スケルトンファイルを変更する 

## アクションスクリプトのスケルトンを生成する

[アクション定義を省略する](ethna-document-dev_guide-action-omit.md "ethna-document-dev\_guide-action-omit (1240d)")にて記述したとおり、一定のルールでアクションスクリプトのファイル名やアクションクラス名が決まるのでしたら、アクションを追加するたびに毎回スクリプトを1から記述するのは面倒です\*1。

そんなときには、ethnaコマンドのadd-actionオプションを利用して、スケルトンファイルを生成すると楽です。

例えば、"some\_action\_name"というアクションを追加したい場合は、

$ ethna add-action some\_action\_name

とするだけです。すると

    generating action script for [some_action_name]...
    action script(s) successfully created [/tmp/sample/app/action
    /Some/Action/Name.php]

というメッセージが表示されてアクションスクリプトのスケルトンが生成されます。

### スケルトンファイルを変更する

実際にはアプリケーション毎にある程度「スケルトンの元になるファイル」を変更したくなると思います。例えば、継承するクラスをEthna\_ActionFormではなく、(Ethna\_ActionFormを継承した)アプリケーション固有のアクションフォームにしたい、といったケースです。

この場合は、プロジェクトスケルトン生成後にskelディレクトリに生成されているはずのskel.action.phpを変更することで、生成されるファイルを任意に変更することが出来ます。


* * *
\*1他のスクリプトからコピー&ペースト、という方法もありますがあんまりカッコよくないし  

