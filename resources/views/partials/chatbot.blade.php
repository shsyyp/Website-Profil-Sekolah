<div class="fixed bottom-8 right-8 z-[60] group">
    <div
        class="absolute bottom-16 right-0 w-80 bg-white rounded-md shadow-2xl overflow-hidden border border-slate-100 opacity-0 group-hover:opacity-100 transition-opacity translate-y-4 group-hover:translate-y-0 duration-300 pointer-events-none group-hover:pointer-events-auto">
        <div class="bg-primary p-4 flex items-center gap-3 text-white">
            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                <span class="material-symbols-outlined">smart_toy</span>
            </div>
            <div>
                <p class="font-bold text-sm">Pintar Assistant</p>
                <p class="text-[10px] opacity-80">Online | Siap membantu</p>
            </div>
        </div>
        <div id="chatbotMessages" class="p-4 bg-slate-50 min-h-[200px] flex flex-col gap-3">
            <div class="bg-white p-3 rounded-md rounded-tl-none shadow-sm text-xs text-slate-600 max-w-[80%]">
                Halo! Ada yang bisa saya bantu terkait pendaftaran atau informasi sekolah?
            </div>
        </div>
        <div class="p-4 bg-white border-t border-slate-100 flex items-center gap-2">
            <input id="chatbotInput"
                class="flex-grow bg-slate-100 border-none rounded-full px-4 py-2 text-xs focus:ring-1 focus:ring-primary"
                placeholder="Tanya sesuatu..." type="text" />
            <button id="chatbotSend" type="button" class="text-tertiary-container hover:text-tertiary transition-colors">
                <span class="material-symbols-outlined text-xl">send</span>
            </button>
        </div>
    </div>

    <button
        class="w-16 h-16 primary-gradient rounded-full shadow-xl shadow-primary/30 flex items-center justify-center text-on-primary hover:scale-110 active:scale-90 transition-all border-4 border-tertiary">
        <span class="material-symbols-outlined text-3xl" data-weight="fill">chat_bubble</span>
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messages = document.getElementById('chatbotMessages');
    const input = document.getElementById('chatbotInput');
    const send = document.getElementById('chatbotSend');
    const humasWhatsappUrl = @json($homepage?->footer_whatsapp_url);
    const knowledge = @json($chatbotItems->map(fn ($item) => [
        'pertanyaan' => $item->pertanyaan,
        'jawaban' => $item->jawaban,
    ])->values());

    function addMessage(text, alignRight = false) {
        const bubble = document.createElement('div');
        bubble.className = alignRight
            ? 'bg-primary text-white p-3 rounded-md rounded-tr-none shadow-sm text-xs max-w-[80%] self-end'
            : 'bg-white p-3 rounded-md rounded-tl-none shadow-sm text-xs text-slate-600 max-w-[80%]';
        bubble.textContent = text;
        messages.appendChild(bubble);
        messages.scrollTop = messages.scrollHeight;
    }

    function addHumasContact() {
        const bubble = document.createElement('div');
        bubble.className = 'bg-white p-3 rounded-md rounded-tl-none shadow-sm text-xs text-slate-600 max-w-[80%]';

        const text = document.createElement('p');
        text.textContent = 'Maaf, saya belum menemukan jawaban yang sesuai. Silakan hubungi Humas melalui WhatsApp untuk bantuan lebih lanjut.';
        bubble.appendChild(text);

        if (humasWhatsappUrl) {
            const link = document.createElement('a');
            link.href = humasWhatsappUrl;
            link.target = '_blank';
            link.rel = 'noopener noreferrer';
            link.className = 'mt-3 inline-flex rounded-full bg-primary px-4 py-2 text-xs font-bold text-white';
            link.textContent = 'Chat WA Humas';
            bubble.appendChild(link);
        }

        messages.appendChild(bubble);
        messages.scrollTop = messages.scrollHeight;
    }

    function answer(question) {
        const normalized = question.toLowerCase();
        const match = knowledge.find((item) => item.pertanyaan.toLowerCase().includes(normalized) || normalized.includes(item.pertanyaan.toLowerCase()));

        addMessage(question, true);
        if (match) {
            addMessage(match.jawaban);
        } else {
            addHumasContact();
        }
        input.value = '';
    }

    send.addEventListener('click', () => {
        const question = input.value.trim();

        if (question) {
            answer(question);
        }
    });

    input.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            send.click();
        }
    });
});
</script>
