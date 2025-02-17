<div id="hs-full-screen-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-full-screen-label">
    <div class="h-full max-w-full max-h-full mt-10 transition-all opacity-0 hs-overlay-open:mt-0 hs-overlay-open:opacity-100 hs-overlay-open:duration-500">
        <div class="flex flex-col h-full max-w-full max-h-full bg-white pointer-events-auto">
            <div class="flex items-center justify-between px-4 py-3 border-b">
                <h3 id="hs-full-screen-label" class="font-bold text-gray-800">
                    Modal title
                </h3>
                <button type="button" class="inline-flex items-center justify-center text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-full-screen-modal">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4 overflow-y-auto">
                <p class="mt-1 text-gray-800">
                    This is a wider card with supporting text below as a natural lead-in to additional content.
                </p>
            </div>
            <div class="flex items-center justify-end px-4 py-3 mt-auto border-t gap-x-2">
                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-full-screen-modal">
                    Close
                </button>
                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>