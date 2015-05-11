# エラーレベルに応じて共通の画面を表示させる

## エラーレベルに応じて共通の画面を表示させる

Ethnaフレームワークでは，全てのエラーをコントローラのhandleErrorメソッドで処理しています． デフォルトでは，ログ出力とアラーとメール送信の処理がEthna_Controllerで定義されています．

    /**
            * エラーハンドラ
            *
            * エラー発生時の追加処理を行いたい場合はこのメソッドをオーバーライドする
            * (アラートメール送信等−デフォルトではログ出力時にアラートメール
            * が送信されるが、エラー発生時に別にアラートメールをここで送信
            * させることも可能)
            *
            * @access public
            * @param object Ethna_Error エラーオブジェクト
            */
           function handleError(&$error)
           {
                   // ログ出力
                   list ($log_level, $dummy) = $this->logger->errorLevelToLogLevel($error->getLevel());
                   $message = $error->getMessage();
                   $this->logger->log($log_level, sprintf("%s [ERROR CODE(%d)]", $message, $error->getCode()));
           }

エラー発生時にこれ以外の処理を行いたい場合，{アプリケーションID}_ControllerにhandleErrorを定義し，オーバーライドすることで，任意の処理を追加することが可能です．

例として，エラーレベルが'Error'の場合に「ただ今混雑しています」と表示させるには，app/{アプリケーションID}_Controller.phpに下記を追加します。

    /**
            * エラーハンドラ
            *
            * @access public
            * @param object Ethna_Error エラーオブジェクト
            */
           function handleError(&$error)
           {
                   // ログ出力
                   list ($log_level, $dummy) = $this->logger->errorLevelToLogLevel($error->getLevel());
                   $message = $error->getMessage();
                   $this->logger->log($log_level, sprintf("%s [ERROR CODE(%d)]", $message, $error->getCode()));
                  
                   //    
                   // template/ja/error.tpl に「ただ今混雑しています」
                   // と書いておく
                   //
                   $renderer = $this->getRenderer();
                   $renderer->perform('error.tpl');
           }

