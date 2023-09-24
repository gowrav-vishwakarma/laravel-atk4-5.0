<?php

namespace Gowrav\LaravelAtkIntegrate;


use Atk4\Data\Persistence\Sql\Mysql\Connection;
use Illuminate\Database\DatabaseManager;

/**
 * Class PersistanceSQLConnection
 *
 * @category Data
 * @package  Gowrav\LaravelAtkIntegrate\Data
 * @author   Gowrav Vishwakarma <gowravvishwakarma@gmail.com>
 * @license  MIT: Gowrav /  Xavoc Technocrats Pvt. Ltd.
 */
class PersistanceSQLConnection extends \Atk4\Data\Persistence\Sql {

	/**
	 * Take a laravel connection and pass it to ATK Data (PDO)
	 *
	 * @param \Illuminate\Database\DatabaseManager $db The Laravel database manager
	 *
	 * @return \atk4\data\Persistence_SQL
	 * @throws \atk4\data\Exception
	 * @throws \atk4\dsql\Exception
	 */
	public $driver = "mysql";
	public function __construct($connection = null) {
		// $pdo = $db->connection()->getPdo();
		// $pdo = app()->make('db')->connection($connection)->getPdo();
		// $conn = new Connection(['connection' => $pdo]);
		// parent::__construct($conn);
	}
}