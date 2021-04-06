<?php

use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$client = ClientBuilder::create()->build();

$response = $client->indices()->create([
    'index' => 'exert-tester-php',
    'body' => [
        'settings' => [
            "analysis" => [
                "analyzer" => [
                    "number_analyzer" => [
                        "type" => "custom",
                        "tokenizer"  => "number_ngram",
                        "filter"  => ["trim"]
                    ],
                ],
                "tokenizer" => [
                    "number_ngram" => [
                        "type" => "ngram",
                        "min_gram" => 1,
                        "max_gram" => 1,
                    ],
                ],
            ],
            "index.max_result_window" => 10000000 // 最大结果窗口
        ],
        "mappings" => [
            "properties" => [
                "account" => [
                    "type" => "text",
                    "fields" => [ // 映射字段
                        "raw" => [ // 名
                            "type" => "keyword", // 用于排序的类型
                        ],
                    ],
                ],
                "nickname" => [ // 字段
                    "type" => "text",
                    "fields" => [ // 映射字段
                        "raw" => [ // 名
                            "type" => "keyword" // 用于排序的类型
                        ],
                    ],
                ],
                "number" => [
                    "type" => "text",
                    "analyzer" => "number_analyzer",
                    "fields" => [
                        "raw" => [
                            "type" => "keyword"
                        ],
                    ],
                ],
            ],
        ],
    ],
]);

print_r($response);
