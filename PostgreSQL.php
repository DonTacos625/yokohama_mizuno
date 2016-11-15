<?php
//======================================================================
//   ■：PostgreSQL クラス
//======================================================================
class PostgreSQL{
	//---------------------------
	// □：変数の宣言
	//---------------------------
	var $p_Rows = 0;
	var $dburl = array();
	var $link;
	//---------------------------
	// □：コンストラクタ
	//---------------------------
	function PostgreSQL(){
		//website上ここから
		// 環境変数から接続情報(DBのURLからhostnameなど)を取得
		$this->dburl = parse_url(getenv('DATABASE_URL'));

		// 変数connへhostnameやdbnameの情報を入れる。
		$this->conn = sprintf('host=%s dbname=%s port=%d user=%s password=%s', $this->dburl['host'], substr($this->dburl['path'], 1), $this->dburl['port'], $this->dburl['user'], $this->dburl['pass']);
		// DBに接続
		$this->link = pg_connect($this->conn);
		//ここまで
		//$this->link = pg_connect("host=localhost dbname=study user=yamamotolab password=yamamoto");
		// 接続失敗時のエラー
		if (!$this->link) {
    	die('接続失敗です。'.pg_last_error());
		}

	}
	//---------------------------
	// SQLクエリの処理
	//---------------------------
	function query($sql,$array){
		$this->p_Rows = pg_query_params($this->link, $sql,$array);
		if (!$this->p_Rows){
			 die("PostgreSQLでエラーが発生しました。<br><b>{$sql}</b><br>" .pg_last_error());
		}
		return $this->p_Rows;
	}
	function query_null($sql){
		$this->p_Rows = pg_query($this->link, $sql);
		if (!$this->p_Rows){
			 die("PostgreSQLでエラーが発生しました。<br><b>{$sql}</b><br>" .pg_last_error());
		}
		return $this->p_Rows;
	}
	//---------------------------
	// 検索結果をfetch
	//---------------------------
	function fetch(){
		return pg_fetch_array($this->p_Rows);
	}
	//---------------------------
	//取得されたすべての行を配列として取得
	//---------------------------
	function fetch_all(){
		return pg_fetch_all($this->p_Rows);
	}
	//---------------------------
	// 変更された行の数を得る
	//---------------------------
	function affected_rows(){
		return pg_affected_rows();
	}
	//---------------------------
	// 列数
	//---------------------------
	function cols(){
		return pg_num_fields($this->p_Rows);
	}
	//---------------------------
	// 行数
	//---------------------------
	function rows(){
		return pg_num_rows($this->p_Rows);
	}
	//---------------------------
	// 検索結果の開放
	//---------------------------
	function free(){
		pg_free_result($this->p_Rows);
	}
	//---------------------------
	// PostgreSQLをクローズ
	//---------------------------
	function close(){
		pg_close($this->link);
	}
	//---------------------------
	// エラーメッセージ
	//---------------------------
	function errors(){
		return pg_last_error();
	}
}
?>
