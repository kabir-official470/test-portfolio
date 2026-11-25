# Shahriar Kabir — Portfolio

A responsive personal portfolio built with PHP, CSS, and a small amount of JavaScript. The root `Dockerfile` packages it with FrankenPHP for deployment on Vercel's Container Runtime.

## Run locally

For quick development, start PHP's built-in server:

```sh
php -S localhost:8000
```

Then open <http://localhost:8000>.

To run the production container locally:

```sh
docker build -t shahriar-portfolio .
docker run --rm -p 8000:80 shahriar-portfolio
```

Then open <http://localhost:8000>.

## Deploy to Vercel

Import this repository into Vercel or deploy it with the Vercel CLI. Vercel detects the root `Dockerfile` and builds the app as a Container Runtime deployment. For an existing project using another framework preset, change its framework to **Container** in Vercel project settings.

## Customize

- Update the name, role, project examples, and skills near the top of `index.php`.
- Set `PORTFOLIO_CONTACT_EMAIL` in Vercel's project environment variables to an address that should receive contact form submissions.
- Contact delivery uses PHP's `mail()` and requires a configured mail transport; setting the recipient address alone does not configure delivery. The form shows an error rather than claiming success when delivery is unavailable.
- Replace the concept project content with your own work before publishing.

## 10-second display timeout

The page sets a browser cookie on the first visit. After 10 seconds, it displays an expired-session screen and keeps showing it on later visits. Clear this site's cookies and site data, then reload to start a new 10-second visit. This is a client-side display behavior, not an authentication or security feature.