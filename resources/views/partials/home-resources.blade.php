@php
  $resources = [
    [
      'image' => 'images/resources/resource-1.jpg',
      'title' => 'How Physical Therapy Speeds Up Recovery After Surgery',
      'excerpt' => 'After surgery, the right movement plan matters as much as rest. Physical therapy helps reduce stiffness, rebuild strength, and get you back to daily life safely and sooner.',
      'href' => route('services'),
    ],
    [
      'image' => 'images/resources/resource-2.jpg',
      'title' => 'What to Expect at Your First Physical Therapy Session',
      'excerpt' => 'Your first visit focuses on understanding your goals, assessing movement, and building a personalized plan—so you know exactly what recovery will look like.',
      'href' => route('about'),
    ],
    [
      'image' => 'images/resources/resource-3.jpg',
      'title' => 'Best Exercises After ACL Surgery (Approved by Therapists)',
      'excerpt' => 'Recovering from ACL surgery is about moving the right way at the right time. Guided therapy rebuilds strength, improves flexibility, and supports a safe return to activity.',
      'href' => route('services'),
    ],
    [
      'image' => 'images/resources/resource-4.jpg',
      'title' => 'Physical Therapy for Kids: How It Works & Why It Matters',
      'excerpt' => 'Kids sometimes need physical therapy too—and for them, it’s more than exercise. Early care supports growth, confidence, and healthy movement patterns.',
      'href' => route('services'),
    ],
    [
      'image' => 'images/resources/resource-5.jpg',
      'title' => 'Physical Therapy for Lower Back Pain: A Complete Guide',
      'excerpt' => 'Lower back pain can interrupt work, hobbies, and daily life. Targeted therapy helps reduce discomfort, restore mobility, and prevent flare-ups.',
      'href' => route('services'),
    ],
    [
      'image' => 'images/resources/resource-6.jpg',
      'title' => 'The Role of Neurological Rehab After Stroke',
      'excerpt' => 'Stroke recovery continues beyond the hospital. Structured neurological rehabilitation helps restore mobility, independence, and quality of life.',
      'href' => route('services'),
    ],
    [
      'image' => 'images/resources/resource-7.jpg',
      'title' => 'Pelvic Floor Physical Therapy: What Patients Should Know',
      'excerpt' => 'Pelvic floor therapy can help with pain, postpartum recovery, and bladder concerns. Many people don’t realize how effective specialized PT can be.',
      'href' => route('services'),
    ],
    [
      'image' => 'images/resources/resource-8.jpg',
      'title' => 'Still in Joint Pain? When Orthopedic Rehabilitation Is the Right Choice',
      'excerpt' => 'Joint pain that lingers isn’t something to ignore. Orthopedic rehab helps address stiffness, weakness, and chronic discomfort before it limits your life.',
      'href' => route('services'),
    ],
  ];
@endphp

<section class="resources-showcase" aria-label="Resources">
  <div class="resources-showcase-inner">
    <h2 class="resources-showcase-title">Resources</h2>

    <div class="resources-showcase-carousel" data-resources-carousel>
      <button type="button" class="resources-showcase-nav resources-showcase-prev" aria-label="Previous resources">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
      </button>

      <div class="resources-showcase-viewport">
        <div class="resources-showcase-track">
          @foreach ($resources as $resource)
            <article class="resources-card">
              <a href="{{ $resource['href'] }}" class="resources-card-link">
                <img
                  src="{{ asset($resource['image']) }}"
                  alt=""
                  class="resources-card-image"
                  width="640"
                  height="360"
                  loading="lazy"
                >
                <div class="resources-card-body">
                  <h3>{{ $resource['title'] }}</h3>
                  <p>{{ $resource['excerpt'] }}</p>
                  <div class="resources-card-author">
                    <img
                      src="{{ asset('images/logo-mark.png') }}"
                      alt=""
                      class="resources-card-avatar"
                      width="36"
                      height="36"
                    >
                    <div>
                      <strong>Integrated Rehab Expert</strong>
                      <span>AUTHOR</span>
                    </div>
                  </div>
                </div>
              </a>
            </article>
          @endforeach
        </div>
      </div>

      <button type="button" class="resources-showcase-nav resources-showcase-next" aria-label="Next resources">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>
      </button>
    </div>
  </div>
</section>
