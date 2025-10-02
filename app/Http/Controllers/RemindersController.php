<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\Tag;

class RemindersController extends Controller
{

    /** แสดงรายการทั้งหมด */
    public function index()
    {
        $reminders = Reminder::with('tags')
            ->where('user_id', request()->user()->id)   // เห็นของตัวเองเท่านั้น
            ->orderBy('remind_at', 'asc')
            ->get();

        return view('reminders.index', compact('reminders'));
    }

    /** ฟอร์มสร้างใหม่ */
    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        return view('reminders.create', compact('tags'));
    }

    /** บันทึกเรคคอร์ดใหม่ */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'remind_at'   => 'required|date',
            'tags'        => 'array',
            'tags.*'      => 'exists:tags,id',
        ]);

        // ✅ ผูกกับผู้ใช้ที่ล็อกอิน เพื่อไม่พลาด user_id
        $reminder = $request->user()->reminders()->create([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'remind_at'   => $validated['remind_at'],
            'status'    => 'New',
        ]);

        // ✅ polymorphic many-to-many: ใช้ sync
        $reminder->tags()->sync($validated['tags'] ?? []);

        return redirect()
            ->route('reminders.index')
            ->with('success', 'Reminder created successfully!');
    }

    /** รายละเอียด */
    public function show(Reminder $reminder)
    {
        // ป้องกันดูของคนอื่น
        abort_unless($reminder->user_id === request()->user()->id, 403);

        $reminder->load('tags');
        return view('reminders.show', compact('reminder'));
    }

    /** ฟอร์มแก้ไข */
    public function edit(Reminder $reminder)
    {
        abort_unless($reminder->user_id === request()->user()->id, 403);

        $tags = Tag::orderBy('name')->get();
        $reminder->load('tags');

        return view('reminders.edit', compact('reminder', 'tags'));
    }

    /** อัปเดต */
    public function update(Request $request, Reminder $reminder)
    {
        abort_unless($reminder->user_id === request()->user()->id, 403);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'remind_at'   => 'required|date',
            'tags'        => 'array',
            'tags.*'      => 'exists:tags,id',
            'status'      => 'nullable|string', // ถ้ามีฟิลด์นี้
        ]);

        $reminder->update([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'remind_at'   => $validated['remind_at'],
            'status'      => 'New',
        ]);


        $reminder->tags()->sync($validated['tags'] ?? []);

        return redirect()
            ->route('reminders.index')
            ->with('success', 'Reminder updated successfully!');
    }

    /** ลบ */
    public function destroy(Reminder $reminder)
    {
        abort_unless($reminder->user_id === request()->user()->id, 403);

        $reminder->delete();

        return redirect()
            ->route('reminders.index')
            ->with('success', 'Reminder deleted successfully!');
    }
}
