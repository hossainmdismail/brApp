@extends('backend.master')

@section('style')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <style>
        label.form-label.w-full {
            width: 100%;
            /* background: aqua; */
            height: 120px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px dotted #a7a7a7;
            cursor: pointer;
        }

        label.form-label.w-full:hover {
            background: #d1d0d0b5;
            transition-duration: 0.200s;
            transition-timing-function: ease-in-out;
        }

        .contentFit {
            height: fit-content;
        }
    </style>
@endsection

@section('content')
    <section class="content-main">
        @if (session('succ'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ session('succ') }}</li>
                </ul>
            </div>
        @endif
        @if (session('err'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('err') }}</li>
                </ul>
            </div>
        @endif

        {{-- {{ $errors }} --}}

        <?php
        print_r($errors);
        ?>

        @livewire('backend.add-product')
    </section>
@endsection


@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        let valueOfVariant = 0; // Declare properly using let

        document.getElementById('addVariant').addEventListener('click', function() {
            // Clone the first accordion item
            const firstAccordionItem = document.querySelector('.accordion-item');
            const clonedAccordionItem = firstAccordionItem.cloneNode(true);

            // Update accordion header and body IDs and text
            const accordionHeader = clonedAccordionItem.querySelector('.accordion-header');
            const accordionCollapse = clonedAccordionItem.querySelector('.accordion-collapse');
            const headingId = 'heading' + (valueOfVariant + 1); // Concatenate number properly
            const collapseId = 'collapse' + (valueOfVariant + 1); // Concatenate number properly
            const button = accordionHeader.querySelector('button');

            accordionHeader.id = headingId;
            accordionHeader.setAttribute('aria-labelledby', headingId);
            accordionHeader.querySelector('button').textContent = 'Attributes #' + (valueOfVariant +
                1); // Concatenate number properly
            button.setAttribute('data-bs-target', '#' + collapseId); // Include '#' in data-bs-target
            button.setAttribute('aria-controls', collapseId);

            accordionCollapse.id = collapseId;
            accordionCollapse.setAttribute('aria-labelledby', headingId);
            accordionCollapse.classList.remove('show');

            // Append the cloned accordion item to the accordion
            document.getElementById('accordionExample').appendChild(clonedAccordionItem);

            valueOfVariant++;

            if (document.querySelectorAll('.accordion-item').length > 1) {
                const deleteButton = document.createElement('button');
                deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'delete-btn', 'contentFit');
                deleteButton.type = 'button';
                deleteButton.type = 'button';
                deleteButton.textContent = 'Delete';
                deleteButton.addEventListener('click', function() {
                    // Find the parent accordion item
                    const accordionItem = deleteButton.closest('.accordion-item');
                    // Remove the accordion item from the DOM
                    accordionItem.remove();
                });
                accordionHeader.appendChild(deleteButton);
            }
        });
    </script>
@endsection
