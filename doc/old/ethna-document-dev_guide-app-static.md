# (ほぼ)スタティックなページを表示させる

## (ほぼ)スタティックなページを表示させる

ほぼスタティックなページを表示させるのは，簡単です． アクションに対して，アクションクラスでは何もせず，遷移先でスタティックなページを作成します．

具体的には，

    class Sample_Action_Login extends Ethna_ActionClass
    {
        function perform()
        {
            return 'login';
        }
    }

とすることで，なにもしないで，スタティックなloginビューを表示することが可能です．

