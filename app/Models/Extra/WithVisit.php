<?php


namespace App\Models\Extra;


use App\Models\Visit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait WithVisit
{

    public function visits()
    {
        return $this->morphMany(Visit::class, 'visitable');
    }

    public function incrementVisit(Request $request)
    {
        $id = 0;
        if (!$this->checkAuth()) {
            try {
                $id = $request->session()->get('guest_key');
            } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
                $id = Str::uuid()->toString();
                $request->session()->put('guest_key', $id);
            }
        } else
            $id = auth()->id();

        $check = Visit::query()->where('user', $id)->where('visitable_id', $this->id)->where('visitable_type', get_class($this))->get()->isNotEmpty();

        if ($check) {
            $visit = Visit::query()->where('user', $id)->where('visitable_id', $this->id)->where('visitable_type', get_class($this))->first();
            $visit->increment('viewCount');
        } else {
            Visit::query()->create([
                'user' => $id,
                'is_guest' => !$this->checkAuth(),
                'useragent' => $request->userAgent(),
                'visit_count' => 1,
                'visitable_id' => $this->id,
                'visitable_type' => get_class($this)
            ]);
        }

        return true;
    }

    public function visitCount()
    {
        return Visit::query()->where('visitable_id', $this->id)->count();
    }

    public function scopeAddView(Builder $query , $order = 'asc')
    {
        return $query->join('prs_visits' , 'prs_visits.visitable_id' , '=' , "prs_{$this->getTable()}.id")
            ->where('visitable_type', get_class($this))
            ->select("prs_{$this->getTable()}" , DB::raw('COUNT(id) as count'))
            ->orderBy('count' , $order);
    }

    private function checkAuth()
    {
        if (auth()->check()) {
            return true;
        }

        return false;
    }

}
