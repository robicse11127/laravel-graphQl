<?php 
namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
    ];

    public function fields() {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'name' => [
                'type' => Type::string(),
            ],
            'email' => [
                'type' => Type::string(),
            ],
            'articles' => [
                'args' => [
                    'id' => [
                        'type' => Type::string()
                    ]
                ],
                'type' => Type::listOf(GraphQL::type('Article')),
            ]
        ];
    }

    public function resolveEmailField($root, $args) {
        return strtolower($root->email);
    }

    public function resolveArticlesField($root, $args) {
        if( isset($args['id']) ) {
            return $root->articles->where('id', $args['id']);
        }
        return $root->articles;
    }
}