# 二重POSTを防止する
  - (1) 登録画面の前のページ(確認画面等)にユニークIDを仕込む 
  - (2) 登録処理の Action で二重POSTをチェックする 
  - (捕捉) 動作原理 

## 二重POSTを防止する [](ethna-document-dev_guide-app-duplicatepost.html#g92d6077 "g92d6077")

### (1) 登録画面の前のページ(確認画面等)にユニークIDを仕込む [](ethna-document-dev_guide-app-duplicatepost.html#cbf75c27 "cbf75c27")

ethnaには二重POSTのチェック用のユニークIDを出力するSmartyプラグイン {uniqid} が用意されています。 以下のように確認画面(ない場合は登録画面) のテンプレートにユニークIDを仕込みます。

POSTの場合(hidden)

    <form method=POST action=index.php>
    <input type="hidden" name="action_user_regist_do" value="1">
     {uniqid}
     :
     :
    </form>

{uniqid} の部分には以下のようなhiddenタグが出力されます。

    <input type="hidden" name="uniqid" value="a0f24f75e...e48864d3e">

GET の場合

    <a href="?action_user_regist_do=1&...&{uniqid type=get}">登録</a>

### (2) 登録処理の Action で二重POSTをチェックする [](ethna-document-dev_guide-app-duplicatepost.html#m5409740 "m5409740")

Ethna\_Util::isDuplicatePost() の返り値が true の場合二重POSTです。 それ以降の処理をスキップして return します。

    function perform()
    	{
               if (Ethna_Util::isDuplicatePost()) {
                  // 二重POSTの場合
                  return 'regist_done';
               }
    
               // 登録処理
                    :
                    :
               return 'regist_done';
    	}

### (捕捉) 動作原理 [](ethna-document-dev_guide-app-duplicatepost.html#a97dbd70 "a97dbd70")

Ethna\_Util::isDuplicatePost() が呼ばれると、project\_root/tmp/ から  
uniqid\_{REMOTE\_ADDR}\_{uniqid} というファイルを探します。  
そのファイルが既に存在する場合は二重POSTとみなし true を返し、ない場合は作成します。  
リクエストに uniqid というパラメータがない場合は 常に falseを返します。  
一時ファイルは1時間で削除されます。

