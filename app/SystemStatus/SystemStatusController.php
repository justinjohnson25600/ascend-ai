<?php

declare(strict_types=1);

namespace App\SystemStatus;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

final class SystemStatusController extends Controller
{
    public function show(StatusReport $status): Response
    {
        $report = $status->build();

        return response()
            ->view('system-status.index', [
                'title' => 'System status',
                'description' => 'Installed versions, updates and security problems for this site.',
                'report' => $report,
                'text' => $status->text($report),
            ])
            ->header('Cache-Control', 'no-store, private');
    }

    public function check(StatusReport $status): RedirectResponse
    {
        $data = $status->check();

        return redirect()
            ->route('system-status')
            ->with('status', $data['errors'] === [] ? 'Checked just now.' : 'Checked just now, but some lookups failed. See the notes below.');
    }
}
