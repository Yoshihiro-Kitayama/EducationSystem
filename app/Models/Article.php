<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'article_contents', 'posted_date'];

    /**
     * 記事をトランザクションで作成
     */
    public static function storeWithTransaction(array $data)
    {
        DB::beginTransaction();
        try {
            $article = self::create($data);
            DB::commit();
            return $article;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * 記事をトランザクションで更新
     */
    public function updateWithTransaction(array $data)
    {
        DB::beginTransaction();
        try {
            $this->update($data);
            DB::commit();
            return $this;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
