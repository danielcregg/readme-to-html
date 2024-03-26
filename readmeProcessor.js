// Moved to separate JavaScript file
async function processReadme(readmeURL) {
    try {
        const rawReadmeURL = await fetchRawReadmeURL(readmeURL);
        const html = await convertReadmeToHTML(rawReadmeURL);
        document.getElementById('output').innerHTML = html;
    } catch (error) {
        console.error('Error processing README:', error);
    }
}

async function fetchRawReadmeURL(readmeURL) {
    // Validate URL before splitting
    if (!readmeURL.startsWith('https://github.com/')) {
        throw new Error('Invalid GitHub URL');
    }

    const urlParts = readmeURL.split('/');
    const user = urlParts[3];
    const repo = urlParts[4];
    const branch = urlParts.includes('blob') ? urlParts[6] : 'main';

    const rawReadmeURL = `https://raw.githubusercontent.com/${user}/${repo}/${branch}/README.md`;
    return rawReadmeURL;
}

async function convertReadmeToHTML(rawReadmeURL) {
    const response = await fetch('convert.php', {
        method: 'POST',
        body: new URLSearchParams({ url: rawReadmeURL })
    });

    if (!response.ok) {
        throw new Error('Error converting README to HTML');
    }

    return response.text();
}