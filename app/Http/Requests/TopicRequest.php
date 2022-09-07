<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;


class TopicRequest extends Request
{

    public function attributes()
    {
        return [
            'category_id' => '分类',
        ];
    }


    public function rules()
    {
        $categories = Category::query()->pluck('id')->toArray();
        switch($this->method())
        {

            // CREATE
            case 'POST':
//            {
//                return [
//                    // CREATE ROLES
//                ];
//            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title' => 'required|min:2',
                    'body' => 'required|min:3',
                    'category_id' =>[
                        'required',
                        'numeric',
                        Rule::in($categories)
                        //下面闭包形式也可以
                        /*
                        function ($attribute, $value, $fail) {
                            $categories = Category::query()->pluck('id')->toArray();
                            if ( !in_array($value, $categories) ) {
                                $fail('分类选择有误');
                            }
                        }
                        */
                        ],

                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.min' => '标题必须至少两个字符',
            'body.required' => '文章内容不能为空',
            'body.min' => '文章内容必须至少三个字符',
            'category_id.in' => '分类选择有误'
        ];
    }
}
