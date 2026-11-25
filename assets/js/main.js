const toggle = document.querySelector('.nav-toggle');
const links = document.querySelector('.nav-links');

const sessionCookie = 'shahriar_portfolio_session';
const sessionDuration = 10_000;
const expiredScreen = document.querySelector('.session-expired-screen');

function readSessionCookie() {
    const cookie = document.cookie
        .split('; ')
        .find((item) => item.startsWith(`${sessionCookie}=`));

    return cookie ? decodeURIComponent(cookie.slice(sessionCookie.length + 1)) : null;
}

function writeSessionCookie(value) {
    const secure = window.location.protocol === 'https:' ? '; Secure' : '';
    document.cookie = `${sessionCookie}=${encodeURIComponent(value)}; Max-Age=31536000; Path=/; SameSite=Lax${secure}`;
}

function expireSession() {
    writeSessionCookie('expired');
    document.documentElement.classList.add('session-expired');

    document.querySelectorAll('body > header, body > main, body > footer').forEach((element) => {
        element.inert = true;
    });

    if (expiredScreen) {
        expiredScreen.hidden = false;
        expiredScreen.querySelector('h1')?.focus();
    }
}

const sessionState = readSessionCookie();

if (expiredScreen && sessionState === 'expired') {
    expireSession();
} else if (expiredScreen) {
    const storedDeadline = Number(sessionState);
    const deadline = Number.isFinite(storedDeadline) && storedDeadline > 0
        ? storedDeadline
        : Date.now() + sessionDuration;

    writeSessionCookie(String(deadline));

    if (deadline <= Date.now()) {
        expireSession();
    } else {
        window.setTimeout(expireSession, deadline - Date.now());
    }
}

if (toggle && links) {
    toggle.addEventListener('click', () => {
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', String(!isOpen));
        links.classList.toggle('is-open', !isOpen);
    });

    links.addEventListener('click', (event) => {
        if (event.target instanceof HTMLAnchorElement) {
            toggle.setAttribute('aria-expanded', 'false');
            links.classList.remove('is-open');
        }
    });
}
