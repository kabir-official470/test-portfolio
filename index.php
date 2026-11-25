<?php
declare(strict_types=1);

$name = 'Shahriar Kabir';
$role = 'Developer & digital problem-solver';
$email = getenv('PORTFOLIO_CONTACT_EMAIL') ?: '';

$projects = [
    [
        'number' => '01',
        'category' => 'Web application',
        'title' => 'Insight dashboard',
        'description' => 'A clear, responsive dashboard concept for exploring important data at a glance.',
        'tags' => ['PHP', 'UI design', 'Responsive'],
        'tone' => 'lavender',
    ],
    [
        'number' => '02',
        'category' => 'E-commerce',
        'title' => 'Everyday goods',
        'description' => 'A thoughtful storefront concept designed to make browsing and buying feel simple.',
        'tags' => ['Frontend', 'Accessibility', 'Commerce'],
        'tone' => 'peach',
    ],
    [
        'number' => '03',
        'category' => 'Personal project',
        'title' => 'The creative journal',
        'description' => 'A lightweight publishing concept for collecting notes, ideas, and inspiration.',
        'tags' => ['Content', 'Performance', 'Design'],
        'tone' => 'mint',
    ],
];

$skills = ['PHP', 'JavaScript', 'HTML & CSS', 'Responsive design', 'Git', 'Problem-solving'];

$formStatus = '';
$formMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $senderName = trim(postString('name'));
    $senderEmail = trim(postString('email'));
    $senderMessage = trim(postString('message'));

    if ($senderName === '' || mb_strlen($senderName) > 100) {
        $formStatus = 'error';
        $formMessage = 'Please enter your name (up to 100 characters).';
    } elseif (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL) || strlen($senderEmail) > 254) {
        $formStatus = 'error';
        $formMessage = 'Please enter a valid email address.';
    } elseif ($senderMessage === '' || mb_strlen($senderMessage) > 5000) {
        $formStatus = 'error';
        $formMessage = 'Please enter a message (up to 5,000 characters).';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formMessage = 'The contact form is not configured yet. Please try again later.';
    } else {
        $subject = 'New portfolio contact message';
        $body = "Name: {$senderName}\nEmail: {$senderEmail}\n\n{$senderMessage}";
        $headers = "Reply-To: {$senderEmail}";

        if (mail($email, $subject, $body, $headers)) {
            $formStatus = 'success';
            $formMessage = 'Thanks for reaching out. Your message has been sent.';
        } else {
            $formStatus = 'error';
            $formMessage = 'Your message could not be sent right now. Please try again later.';
        }
    }
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function postString(string $key): string
{
    $value = $_POST[$key] ?? '';

    return is_string($value) ? $value : '';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The portfolio of Shahriar Kabir, developer and digital problem-solver.">
    <meta name="theme-color" content="#f7f6f2">
    <title><?= e($name) ?> — <?= e($role) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <nav class="nav container" aria-label="Main navigation">
            <a class="brand" href="#home" aria-label="<?= e($name) ?>, home">
                <span class="brand-mark">SK</span>
                <span><?= e($name) ?></span>
            </a>
            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="nav-links">
                <span class="sr-only">Toggle navigation</span>
                <span></span><span></span>
            </button>
            <div class="nav-links" id="nav-links">
                <a href="#about">About</a>
                <a href="#work">Work</a>
                <a href="#skills">Skills</a>
                <a class="nav-contact" href="#contact">Let's talk <span aria-hidden="true">↗</span></a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero container" id="home">
            <div class="hero-copy">
                <p class="eyebrow"><span class="status-dot"></span> Available for new opportunities</p>
                <h1>Making the web<br>work <span class="accent-word">better.</span></h1>
                <p class="hero-intro">Hi, I’m <strong><?= e($name) ?></strong> — a developer who enjoys turning thoughtful ideas into useful, easy-to-use digital experiences.</p>
                <div class="hero-actions">
                    <a class="button button-dark" href="#work">Explore my work <span aria-hidden="true">↓</span></a>
                    <a class="text-link" href="#contact">Get in touch <span aria-hidden="true">↗</span></a>
                </div>
                <div class="hero-note">
                    <span class="note-line"></span>
                    <span>Curious by nature. Detail-minded by choice.</span>
                </div>
            </div>
            <div class="hero-art" aria-label="Abstract illustration with the initials SK" role="img">
                <div class="art-orbit orbit-one"></div>
                <div class="art-orbit orbit-two"></div>
                <div class="art-sun"></div>
                <div class="art-card">
                    <span class="art-card-label">A little about me</span>
                    <span class="art-monogram">S<span>K</span></span>
                    <span class="art-card-footer">BUILD · LEARN · REPEAT</span>
                </div>
                <span class="art-spark spark-one">✳</span>
                <span class="art-spark spark-two">✳</span>
                <span class="art-caption">01 / 03</span>
            </div>
            <a class="scroll-cue" href="#about"><span></span> Scroll to explore</a>
        </section>

        <section class="section about-section" id="about">
            <div class="container about-grid">
                <div>
                    <p class="eyebrow">A bit about me</p>
                    <h2>Good work starts<br>with <span class="serif-accent">good questions.</span></h2>
                </div>
                <div class="about-copy">
                    <p>I like making digital things that feel considered, work reliably, and make someone’s day a little easier. My approach brings together practical development, an eye for detail, and a willingness to keep learning.</p>
                    <p>From the first sketch to the finishing touches, I care about building experiences that are clear, accessible, and made to last.</p>
                    <a class="text-link" href="#contact">A project in mind? <span aria-hidden="true">↗</span></a>
                </div>
            </div>
        </section>

        <section class="section work-section" id="work">
            <div class="container">
                <div class="section-heading">
                    <div>
                        <p class="eyebrow">Selected explorations</p>
                        <h2>Ideas, made <span class="serif-accent">tangible.</span></h2>
                    </div>
                    <p class="section-side-note">A few concept projects showing the kinds of problems I enjoy thinking about.</p>
                </div>
                <div class="project-grid">
                    <?php foreach ($projects as $project): ?>
                        <article class="project-card">
                            <div class="project-art project-art-<?= e($project['tone']) ?>">
                                <span class="project-number"><?= e($project['number']) ?></span>
                                <div class="project-preview" aria-hidden="true">
                                    <span class="preview-bar"></span>
                                    <span class="preview-line line-long"></span>
                                    <span class="preview-line line-short"></span>
                                    <span class="preview-block"></span>
                                    <span class="preview-block preview-block-small"></span>
                                </div>
                                <span class="project-arrow" aria-hidden="true">↗</span>
                            </div>
                            <div class="project-meta">
                                <p class="project-category"><?= e($project['category']) ?></p>
                                <h3><?= e($project['title']) ?></h3>
                                <p class="project-description"><?= e($project['description']) ?></p>
                                <ul class="tag-list" aria-label="Project themes">
                                    <?php foreach ($project['tags'] as $tag): ?>
                                        <li><?= e($tag) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="section skills-section" id="skills">
            <div class="container skills-grid">
                <div>
                    <p class="eyebrow">Things I work with</p>
                    <h2>Useful tools.<br><span class="serif-accent">Useful outcomes.</span></h2>
                </div>
                <div>
                    <p class="skills-intro">A growing toolkit for designing, building, and improving web experiences.</p>
                    <ul class="skill-list">
                        <?php foreach ($skills as $index => $skill): ?>
                            <li><span>0<?= $index + 1 ?></span><?= e($skill) ?><span class="skill-plus" aria-hidden="true">+</span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section contact-section" id="contact">
            <div class="container contact-grid">
                <div class="contact-copy">
                    <p class="eyebrow">Have something in mind?</p>
                    <h2>Let’s make<br><span class="serif-accent">it happen.</span></h2>
                    <p>Tell me a little about what you’re working on. I’d love to hear from you.</p>
                    <?php if ($email !== ''): ?>
                        <a class="contact-email" href="mailto:<?= e($email) ?>"><?= e($email) ?> <span aria-hidden="true">↗</span></a>
                    <?php endif; ?>
                </div>
                <form class="contact-form" method="post" action="#contact">
                    <?php if ($formMessage !== ''): ?>
                        <p class="form-message form-message-<?= e($formStatus) ?>" role="status"><?= e($formMessage) ?></p>
                    <?php endif; ?>
                    <label for="name">Your name</label>
                    <input id="name" name="name" type="text" maxlength="100" autocomplete="name" required value="<?= e(postString('name')) ?>">
                    <label for="email">Email address</label>
                    <input id="email" name="email" type="email" maxlength="254" autocomplete="email" required value="<?= e(postString('email')) ?>">
                    <label for="message">A little about your project</label>
                    <textarea id="message" name="message" rows="4" maxlength="5000" required><?= e(postString('message')) ?></textarea>
                    <button class="button button-light" type="submit" name="contact_submit" value="1">Send a message <span aria-hidden="true">↗</span></button>
                    <p class="form-footnote">Your details are only used to reply to your message.</p>
                </form>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <a class="brand footer-brand" href="#home"><span class="brand-mark">SK</span><span><?= e($name) ?></span></a>
            <p>Designed with care. Built with purpose.</p>
            <a class="back-to-top" href="#home">Back to top ↑</a>
            <span class="copyright">© <?= date('Y') ?> <?= e($name) ?></span>
        </div>
    </footer>
    <div class="session-expired-screen" hidden role="alertdialog" aria-modal="true" aria-labelledby="session-expired-title">
        <div class="session-expired-card">
            <p class="eyebrow">Session ended</p>
            <h1 id="session-expired-title" tabindex="-1">This visit has expired.</h1>
            <p>To start a new visit, clear this site's cookies and site data in your browser, then reload the page.</p>
        </div>
    </div>
    <script src="assets/js/main.js" defer></script>
</body>
</html>
