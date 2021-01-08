<?php

require "SyncStockingWidget.php";

beforeEach(function () {
  $sync = new SyncStockingWidget();
  $GLOBALS["sync"] = $sync;

  $sync->set_CSV(__DIR__ . "/example-data.xlsx");
});

test(
  "set_CSV accept a file location and set to global CSV variable",
  function () {
    global $sync;
    expect($sync->spreadsheet)->not->toBeEmpty();
  }
);

test(
  "data_is_old returns false when newly created file is given as parameter",
  function () {
    global $sync;
    $test_file_path = __DIR__ . "/new-file.xlsx";

    $fp = fopen($test_file_path, "w");
    fwrite($fp, "hello");
    fclose($fp);

    expect($sync->data_is_old($test_file_path))->toBeFalse();

    unlink($test_file_path);
  }
);

test("get_CSV returns spreadsheet", function () {
  global $sync;
  $spreadsheet = $sync->get_CSV();
  expect($spreadsheet)->not->toBeEmpty();
});

test("get_cell returns value of cell coordinates", function () {
  global $sync;
  $cell = $sync->get_cell(2, 3);
  expect($cell)->toBe(9);
});

test(
  "get_remote_product_from_row returns value of cell coordinates",
  function () {
    global $sync;
    $sync->set_sku_column(2);
    $sync->set_stock_column(3);

    $product = $sync->get_remote_product_from_row(3);
    expect(sizeof($product))->toBe(2);

    expect($product["stock"])->toBe(5);
  }
);

test("get_row_count returns total number of rows", function () {
  global $sync;

  expect($sync->get_row_count())->toBe(4);
});

test("returns path to wp-config", function () {
  global $sync;

  expect($sync->get_path_to_wp_config())->toBe(
    "/home/greg/vagrant-local/www/wordpress-iww/public_html/wp-config.php"
  );
});

// test(
//   "get_product_id_by_sku returns ID if given a SKU in the database",
//   function () {
//     global $sync;

//     expect($sync->get_product_id_by_sku("70127_990-S"))->toBe(3805);
//   }
// );
