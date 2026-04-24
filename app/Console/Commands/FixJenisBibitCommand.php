<?php

namespace App\Console\Commands;

use App\Models\Penanaman;
use Illuminate\Console\Command;

class FixJenisBibitCommand extends Command
{
    protected $signature = 'fix:jenis-bibit {from} {to}';
    protected $description = 'Update jenis bibit dari nilai lama ke nilai baru';

    public function handle()
    {
        $from = $this->argument('from');
        $to = $this->argument('to');

        $this->info("Mengupdate jenis bibit dari '{$from}' ke '{$to}'...");

        // Cek dulu data yang akan diupdate
        $dataToUpdate = Penanaman::where('jenis_bibit', $from)->get();
        
        if ($dataToUpdate->isEmpty()) {
            $this->warn("Tidak ada data dengan jenis bibit '{$from}'");
            return 0;
        }

        $this->info("Data yang akan diupdate:");
        foreach ($dataToUpdate as $p) {
            $this->line("ID: {$p->id}, Jenis: {$p->jenis_bibit}, Jumlah: {$p->jumlah_bibit}");
        }

        // Konfirmasi
        if (!$this->confirm('Lanjutkan update?')) {
            $this->info('Update dibatalkan');
            return 0;
        }

        // Lakukan update
        $updated = Penanaman::where('jenis_bibit', $from)->update(['jenis_bibit' => $to]);

        $this->info("✅ Berhasil mengupdate {$updated} records");

        // Tampilkan hasil setelah update
        $this->info("\nData setelah update:");
        $updatedData = Penanaman::where('jenis_bibit', $to)->get();
        foreach ($updatedData as $p) {
            $this->line("ID: {$p->id}, Jenis: {$p->jenis_bibit}, Jumlah: {$p->jumlah_bibit}");
        }

        return 0;
    }
}
