<?php // new App\MyClasses\Data2
// app('data2')->config('modules') | data2('modules')
// https://www.youtube.com/watch?v=ceppjNEVt_w&list=PLXCVm4GFpx5CZf4X5ppNJTPsaGwSlBXLX&index=6

namespace App\MyClasses;

class Data2
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function test()
    {
        return 'tested';
    }

    public function config(string $key)
    {
        return $this->config[$key] ?? null;
    }
}