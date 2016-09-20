<?php
$arr1 = Array(
 Array(
  'zip_code',
  'rate_namevalid_since',
  'source_rate_id',
  'consumption_from',
  'consumption_until',
  'monthly_base_price',
  'working_price',
  'is_business_rate',
  'bonus1_amount',
  'bonus1_external_ID'
),

Array(
 '1067',
 'Shell PrivatEnergie Strom Bonus 12',
 '15.09.16',
 '3',
 '500',
 '1499',
 '100',
'25,01',
'FALSE',
'0'
)


);


$arr2 = Array(
  'zip_code',
  'rate_namevalid_since',
  'source_rate_id',
  'source_rate_id2',
  'consumption_from',
  'consumption_until',
  'just a test',
  'monthly_base_price',
  'working_price',
  "one more here",
  'is_business_rate',
  'bonus1_amount',
  'bonus1_external_ID',
  'we have more fields',
  "and more"
);

print "<pre>";
print_r($arr1);
print "</pre>";
print "<pre>";
print_r($arr2);
print "</pre>";

        $union = array_diff($arr2, $arr1[0]);

        foreach($union as $key=>$value){
          array_splice($arr1[0], $key, 0, $value);
          array_splice($arr1[1], $key, 0, "Test");
        }
        print "<pre>";
        print_r($arr1);
        print "</pre>";


 ?>
