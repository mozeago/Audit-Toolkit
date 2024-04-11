<?php

use Livewire\Volt\Component;
use App\Models\UserResponse;
use App\Models\User;
use App\Models\RiskAnalysisResponse;
new class extends Component {
    public $data = [];
    public $chartColors = [];
    public $value = 15;
    public $color;
    public $label;

    public function mount()
    {
        $this->setColors();
    }
    public function setColors()
    {
        if ($this->value < 25) {
            $this->color = '#FF0000'; // Red
            $this->label = 'Poor';
        } elseif ($this->value >= 25 && $this->value < 50) {
            $this->color = '#FFA500'; // Orange
            $this->label = 'Average';
        } elseif ($this->value >= 50 && $this->value < 75) {
            $this->color = '#FFFF00'; // Yellow
            $this->label = 'Good';
        } else {
            $this->color = '#00FF00'; // Green
            $this->label = 'Excellent';
        }
    }
    public function getUserAuditAnswers()
    {
        $score = UserResponse::where('user_id', auth()->user()->id)
            ->selectRaw('round( (sum(case when answer = \'true\' then 1 else 0 end) / count(*)) * 100) as score')
            ->first();

        return $score->score;
    }
    public function getUserRiskAnswers()
    {
        $score = RiskAnalysisResponse::where('user_id', auth()->user()->id)
            ->selectRaw('round( (sum(case when answer = \'true\' then 1 else 0 end) / count(*)) * 100) as score')
            ->first();

        return $score->score;
    }
    // public function generateGaugeChart()
    // {
    //     // Define gauge chart dimensions
    //     $chartWidth = 250;
    //     $chartHeight = 250;

    //     // Create a new image
    //     $image = imagecreate($chartWidth, $chartHeight);

    //     // Define gradient colors
    //     $startColor = imagecolorallocate($image, 255, 0, 0); // Red
    //     $endColor = imagecolorallocate($image, 0, 255, 0); // Green

    //     // Fill the background with a gradient
    //     for ($i = 0; $i < $chartHeight; $i++) {
    //         // Calculate gradient color at this position
    //         $r = ($i * (255 - 0)) / $chartHeight + 0;
    //         $g = ($i * (255 - 0)) / $chartHeight + 0;
    //         $b = ($i * (255 - 0)) / $chartHeight + 0;
    //         $color = imagecolorallocate($image, $r, $g, $b);

    //         // Draw a horizontal line
    //         imageline($image, 0, $i, $chartWidth, $i, $color);
    //     }

    //     // Draw the gauge outline
    //     $outlineColor = imagecolorallocate($image, 0, 0, 0); // Black
    //     imagerectangle($image, 0, 0, $chartWidth - 1, $chartHeight - 1, $outlineColor);

    //     // Save the image to a buffer
    //     ob_start();
    //     imagepng($image);
    //     $imageData = ob_get_contents();
    //     ob_end_clean();

    //     // Destroy the image to free up memory
    //     imagedestroy($image);

    //     // Encode the image data as base64
    //     $this->gaugeChartImage = base64_encode($imageData);
    // }
}; ?>
<div>
    <div class="gauge-container">
        <div class="gauge-bar"
            style="background: linear-gradient(to top, {{ $color }}, #00ff00); transform: rotate({{ $value * 1.8 - 135 }}deg);">
        </div>
        <div class="gauge-labels">
            <div class="label top">{{ $label }}</div>
            <div class="label bottom">0%</div>
        </div>
    </div>
    <div class="flex">
        <!-- Left column -->
        <div class="w-1/3 mr-4 border rounded-lg">
            <h1 class="py-4 text-3xl font-bold text-center text-gray-800">Risk Profile Score</h1>
            <div style="display: flex;">
                <canvas id="gaugeChart" width="250" height="250"></canvas>
                <!-- Change canvas id to 'gaugeChart' -->
            </div>
            <div class="h-24 mt-5 bg-orange-500">
                <p class="text-xl">{{ round(($this->getUserRiskAnswers() + $this->getUserAuditAnswers()) / 2, 0) }}%</p>
            </div>
        </div>

        <!-- Right column -->
        <div class="w-1/4">
            <div class="grid grid-cols-2 gap-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                <div class="h-24 bg-green-500"></div>
                <div class="h-24 bg-orange-500"></div>
                <div class="h-24 bg-red-500"></div>
                <div class="h-24 bg-yellow-400"></div>
            </div>
        </div>

    </div>
</div>
