<?php

namespace Tests\Feature;

use App\Models\PMB;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_pmb_page_returns_a_successful_response(): void
    {
        $this->get('/pmb')->assertStatus(200);
    }

    public function test_admin_can_store_structured_pmb_lists(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('admin.pmb.update'), [
            'active_panel' => 'pmb-steps-section',
            'steps_label' => 'Langkah Mudah',
            'steps_title' => 'Alur Pendaftaran',
            'alur' => [
                ['title' => 'Seleksi Administrasi'],
                ['title' => 'Tes Akademik'],
            ],
        ])->assertSessionHasNoErrors();

        $this->post(route('admin.pmb.update'), [
            'active_panel' => 'pmb-requirements-section',
            'persyaratan_umum' => [['text' => 'Warga Negara Indonesia']],
            'berkas' => [['text' => 'Persetujuan orang tua']],
        ])->assertSessionHasNoErrors();

        $this->post(route('admin.pmb.update'), [
            'active_panel' => 'pmb-timeline-section',
            'timeline_title' => 'Timeline Pendaftaran',
            'jadwal' => [[
                'kegiatan' => 'Seleksi Administrasi',
                'tanggal_mulai' => '2026-03-02',
                'tanggal_selesai' => '2026-03-29',
                'tanggal_legacy' => '',
            ]],
        ])->assertSessionHasNoErrors();

        $this->post(route('admin.pmb.update'), [
            'active_panel' => 'pmb-faq-section',
            'faq_title' => 'Pertanyaan Umum',
            'faq' => [[
                'pertanyaan' => 'Kapan pendaftaran dibuka?',
                'jawaban' => 'Pendaftaran dibuka pada bulan Maret.',
            ]],
        ])->assertSessionHasNoErrors();

        $pmb = PMB::firstOrFail();
        $this->assertCount(2, $pmb->alur);
        $this->assertSame('Warga Negara Indonesia', $pmb->persyaratan_umum[0]['text']);
        $this->assertSame('2026-03-29', $pmb->jadwal[0]['tanggal_selesai']);
        $this->assertSame('Kapan pendaftaran dibuka?', $pmb->faq[0]['pertanyaan']);

        $this->get('/pmb')
            ->assertOk()
            ->assertSee('Seleksi Administrasi')
            ->assertSee('Warga Negara Indonesia')
            ->assertSee('Kapan pendaftaran dibuka?');
    }
}
