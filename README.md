# Lansen PHP Implementation

## Motivation

After I had a chance to look at the tech stack, I found that PHP didn't
require special work-arounds that using rust would. I could be using the
apache on the system to proxy requests to a rust service. Or I could just
write in PHP since it was already going to be present for me.

Provided docker compose to simulate the basics of the web host, though it's
using apache virtual servers and serves wordpress in a single click through CPanel.

# Structure

The SPA is in a different project. The docker composes the compiled VUE app
with the small amount of server side needed to save contacts and quotes.