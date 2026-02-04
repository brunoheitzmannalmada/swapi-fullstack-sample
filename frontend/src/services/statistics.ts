import { api } from '@/services/api';
import type { StatisticsResponse } from '@/models/statistics';

export const fetchStatistics = () => api.get<StatisticsResponse>('/star-wars/statistics');