import { config, library, dom } from '@fortawesome/fontawesome-svg-core';
config.autoReplaceSvg = 'nest';
import {
    faCaretUp,
    faCaretDown,
    faStar,
    faCheck,
    faThumbsUp,
    faThumbsDown
} from '@fortawesome/free-solid-svg-icons';

library.add(faCaretUp,
    faCaretDown,
    faStar,
    faThumbsUp,
    faThumbsDown,
    faCheck);

dom.watch();

