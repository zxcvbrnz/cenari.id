<?php

// App/Livewire/PortfolioGallery.php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;

class PortfolioGallery extends Component
{
    public $filter = 'all';

    public function setFilter($categoryId)
    {
        $this->filter = $categoryId;
    }

    public function getProjectsProperty()
    {
        return Portfolio::with(['categories', 'featuredImage', 'images'])
            ->when($this->filter !== 'all', function ($query) {
                $query->whereHas('categories', function ($q) {
                    $q->where('portfolio_categories.id', $this->filter);
                });
            })
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.portfolio-gallery', [
            'projects' => $this->projects,
            'categories' => PortfolioCategory::all()
        ]);
    }
}
