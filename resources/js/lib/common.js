import { config } from 'Config';
import moment from 'moment-timezone';
import 'vue-good-table/dist/vue-good-table.css';

moment.tz.setDefault(config.timezone);
