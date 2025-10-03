<?

namespace App\Exports;

use App\Models\PartnerAdmin\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Participant::with(['center', 'batch'])
            ->select('full_name', 'participant_code', 'email', 'mobile', 'aadhar_number', 'academic_session')
            ->get()
            ->map(function ($participant) {
                return [
                    'Full Name' => $participant->full_name,
                    'Code' => $participant->participant_code,
                    'Email' => $participant->email ?? 'N/A',
                    'Contact' => $participant->mobile ?? 'N/A',
                    'Aadhar' => $participant->aadhar_number ?? 'N/A',
                    'Session' => $participant->academic_session ?? 'N/A',
                    'Center' => $participant->center->title ?? 'N/A',
                    'Batch' => $participant->batch->batch_title ?? 'N/A',
                    'State/District' => $participant->state_name . '/' . $participant->dist_name,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Code',
            'Email',
            'Contact',
            'Aadhar',
            'Session',
            'Center',
            'Batch',
            'State/District'
        ];
    }
}
