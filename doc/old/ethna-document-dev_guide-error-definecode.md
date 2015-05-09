# エラーコードの定義

## エラーコードの定義 [](ethna-document-dev_guide-error-definecode.html#c5815ad9 "c5815ad9")

エラーコードは，app/{アプリケーションID}\_Error.phpに定義します．

app/Sample\_Error.php:

    $i = 259;
    /** エラーコード: ユーザ認証エラー */
    define('E_SAMPLE_AUTH', $i++);

259までのエラーコードはフレームワークで予約されていますのでエラーコードには300以上の整数を使用してください。

