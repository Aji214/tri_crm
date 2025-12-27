<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectItem;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have dependencies
        $leads = Lead::all();
        $products = Product::all();

        if ($leads->isEmpty() || $products->isEmpty()) {
            $this->command->error('Leads or Products not found. Please seed them first.');
            return;
        }

        // Scenario 1: Standard Project (Completed)
        // Lead: PT Teknologi Maju Jaya (Index 0)
        // Item: Internet 100Mbps (Index 1) - Normal Price
        $lead1 = $leads[0];
        $prod1 = $products[1]; // Internet 100Mbps
        
        $project1 = Project::create([
            'lead_id' => $lead1->id,
            'name' => 'Instalasi Internet Kantor Pusat',
            'total_amount' => $prod1->price,
            'status' => 'completed',
        ]);

        ProjectItem::create([
            'project_id' => $project1->id,
            'product_id' => $prod1->id,
            'quantity' => 1,
            'base_price' => $prod1->price,
            'negotiated_price' => $prod1->price, // No discount
        ]);

        // Scenario 2: Project Waiting Approval (Discounted)
        // Lead: Restoran Rasa Nusantara (Index 1)
        // Item: Internet 50Mbps (Index 0) - Discounted
        $lead2 = $leads[1];
        $prod2 = $products[0]; // Internet 50Mbps, Price ~300k
        $discountedPrice = $prod2->price - 50000;

        $project2 = Project::create([
            'lead_id' => $lead2->id,
            'name' => 'WiFi Restoran Cabang Jogja',
            'total_amount' => $discountedPrice,
            'status' => 'waiting_approval',
        ]);

        ProjectItem::create([
            'project_id' => $project2->id,
            'product_id' => $prod2->id,
            'quantity' => 1,
            'base_price' => $prod2->price,
            'negotiated_price' => $discountedPrice,
        ]);

        // Scenario 3: Mixed Items (Approved)
        // Lead: Hotel Bintang Lima (Index 2)
        // Item A: Router AX3000 (Index 3) - Normal
        // Item B: IP Public (Index 2) - Discounted
        $lead3 = $leads[2];
        $prodRouter = $products[3];
        $prodIp = $products[2];
        $ipDiscount = $prodIp->price * 0.9; // 10% off

        $total3 = ($prodRouter->price * 5) + ($ipDiscount * 1);

        $project3 = Project::create([
            'lead_id' => $lead3->id,
            'name' => 'Upgrade Network Infrastructure Layout',
            'total_amount' => $total3,
            'status' => 'approved',
        ]);

        ProjectItem::create([
            'project_id' => $project3->id,
            'product_id' => $prodRouter->id,
            'quantity' => 5,
            'base_price' => $prodRouter->price,
            'negotiated_price' => $prodRouter->price,
        ]);

        ProjectItem::create([
            'project_id' => $project3->id,
            'product_id' => $prodIp->id,
            'quantity' => 1,
            'base_price' => $prodIp->price,
            'negotiated_price' => $ipDiscount,
        ]);
        
        // Scenario 4: Rejected Project
        $lead4 = $leads[3];
        $prod4 = $products[0];
        $rejectedPrice = $prod4->price / 2; // 50% off (Too low!)

        $project4 = Project::create([
            'lead_id' => $lead4->id,
            'name' => 'Penawaran CSR Sekolah',
            'total_amount' => $rejectedPrice * 10,
            'status' => 'rejected',
        ]);

        ProjectItem::create([
             'project_id' => $project4->id,
            'product_id' => $prod4->id,
            'quantity' => 10,
            'base_price' => $prod4->price,
            'negotiated_price' => $rejectedPrice,
        ]);
    }
}
