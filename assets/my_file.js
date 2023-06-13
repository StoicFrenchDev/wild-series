import {
    trans,
    TRANSLATION_SIMPLE,
    TRANSLATION_WITH_PARAMETERS,
    TRANSLATION_MULTI_DOMAINS,
    TRANSLATION_MULTI_LOCALES,
} from './translator';

// No parameters, uses the default domain ("messages") and the default locale
trans(TRANSLATION_SIMPLE);

// Two parameters "count" and "foo", uses the default domain ("messages") and the default locale
trans(TRANSLATION_WITH_PARAMETERS, { count: 123, foo: 'bar' });

// No parameters, uses the default domain ("messages") and the default locale
trans(TRANSLATION_MULTI_DOMAINS);
// Same as above, but uses the "domain2" domain
trans(TRANSLATION_MULTI_DOMAINS, {}, 'domain2');
// Same as above, but uses the "domain3" domain
trans(TRANSLATION_MULTI_DOMAINS, {}, 'domain3');

// No parameters, uses the default domain ("messages") and the default locale
trans(TRANSLATION_MULTI_LOCALES);
// Same as above, but uses the "fr" locale
trans(TRANSLATION_MULTI_LOCALES, {}, 'Bonjour!', 'fr');
// Same as above, but uses the "en" locale
trans(TRANSLATION_MULTI_LOCALES, {}, 'Hello!', 'en');