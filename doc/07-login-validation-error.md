[[目次](README.md)]
# 実用的なアプリケーション開発 3 バリデーションエラー
## エラー処理(フォーム値の表示)

(自動にせよ手動にせよ)フォーム値の検証を行ってエラーが発生したら、それに伴って幾つかの処理を行う必要があります。

まずは最低限の処理その1ということで、入力されたフォーム値をvalue属性に設定してみます。

フォーム値はEthnaフレームワークによって自動的にSmarty変数として割り当てられるので、実際にはテンプレートで

`{$form.フォーム項目名}`

と記述すればOKです。ですのでここではlogin.tplを以下のように変更します。

template/ja_JP/login.tpl:

```diff
    <tr>
     <td>メールアドレス</td>
 -   <td><input type="text" name="mailaddress" value=""></td>
 +   <td><input type="text" name="mailaddress" value="{$form.mailaddress}"></td>
    </tr>
```

この状態で、メールアドレスのみを入力してsubmitすると、(パスワードが入力されていないのでエラーにはなりますが)メールアドレスのフォーム値が失われずに表示されていると思います。

なお、{$form.*}で表示される値は常にエスケープされていますので、サニタイズ等は考慮する必要はありません。*2

## エラー処理(エラーメッセージの表示)

次に最低限の処理その2である、エラーメッセージの表示を行います。発生したエラーは、やはりEthnaフレームワークによって自動的にテンプレート変数として割り当てられ、

全てのエラーメッセージ一覧
指定されたフォーム名に対応するエラーメッセージ
という形でアクセスすることが可能です。

まず全てのエラーメッセージを表示させてみます。エラーメッセージは配列として{$errors}というSmarty変数に割り当てられていますので:

template/ja_JP/login.tpl:

```diff
 <body>
+ {if count($errors)}
+  <ul>
+  {foreach from=$errors item=error}
+   <li>{$error}</li>
+  {/foreach}
+ </ul>
+{/if}
```

というように書くと、全てのエラーメッセージを表示させることが出来ます。

また、特定のフォーム名に対応するエラーメッセージを表示させるには、Ethnaフレームワークの提供するSmarty関数"message"を利用します。

template/ja_JP/login.tpl:

```html
    <tr>
     <td>メールアドレス</td>
     <td><input type="text" name="mailaddress" value="{$form.mailaddress}">{message name="mailaddress"}</td>
    </tr>
    <tr>
     <td>パスワード</td>
     <td><input type="password" name="password" value="">{message name="password"}</td>
     </tr>
```

Ethnaフレームワークにおけるエラー処理ポリシーについては以下をご覧下さい。

see also: エラー処理ポリシー

また、自動検証で設定されるエラーメッセージは(もちろん)任意にカスタマイズすることが出来ます。

see also: [自動検証のエラーメッセージをカスタマイズする]
