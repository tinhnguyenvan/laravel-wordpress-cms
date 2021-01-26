<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ base_url() }}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',time()) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>

    @foreach ($navs as $nav)
        <url>
            <loc>{{ $nav->value }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($nav->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    @foreach ($posts as $post)
        <url>
            <loc>{{ $post->link }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($post->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach

    @foreach ($tags as $tag)
        <url>
            <loc>{{ \App\Models\PostTag::link($tag) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($tag->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>
