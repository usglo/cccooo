<?php
/**
 * PmaBookmarkFixture
 *
 */
class PmaBookmarkFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'pma_bookmark';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'dbase' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'user' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'label' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'query' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'dbase' => 'Lorem ipsum dolor sit amet',
			'user' => 'Lorem ipsum dolor sit amet',
			'label' => 'Lorem ipsum dolor sit amet',
			'query' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
